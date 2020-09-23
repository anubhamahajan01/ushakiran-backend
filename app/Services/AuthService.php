<?php

namespace App\Services;

use DB;
use Hash;
use JWTAuth;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Validators\AuthValidator;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ActionForbiddenException;
use App\Exceptions\InvalidCredentialException;
use App\Repositories\Contracts\UserRepository;

class AuthService 
{
    /**
     * @var /App/Repositories/Contracts/UserRepository
     */
    protected $users;

    /**
     * Auth Service instance
     * @param UserRepository $users
     */
    public function __construct(
        UserRepository $users
    ){
        $this->users = $users;
    }

    public function login($inputs, AuthValidator $validator)
    {
        $validator->fire($inputs, 'login');
        
        if(Auth::attempt($inputs)){
            $user = $this->users->firstWhere('email', Arr::get($inputs, 'email'));
            if($user->is_admin)
                throw new ActionForbiddenException('Please login using Admin Panel');
            $user['token'] = JWTAuth::fromUser($user);
            return $user;
        }
        throw new InvalidCredentialException('invalid credentials');

    }

    public function register($inputs, Authvalidator $validator)
    {
        $validator->fire($inputs, 'register');

        $inputs['password'] = bcrypt($inputs['password']);
        $inputs['email'] = strtolower($inputs['email']);

        $user = $this->users->create(Arr::only($inputs, [
            'name', 'email', 'password', 'phone', 'address'
        ]));

        $user['token'] = JWTAuth::fromUser($user);
        return $user;
    }

    public function verifyEmail($inputs, AuthValidator $validator)
    {
        $validator->fire($inputs, 'verify_email');
        $user = $this->users->firstWhere('email', Arr::get($inputs, 'email'), null, false);
        if(!$user)
            throw new ActionForbiddenException('Email does not exists');

        app(\App\Tasks\SendPasswordResetToken::class)
            ->handle($user);

        return;
    }

    public function resetPassword($token)
    {
        $tokenData = DB::table('password_resets')
            ->where('token', $token)->first();

        if ( !$tokenData || (carbon()->now()->diffInMinutes($tokenData->created_at) > 59)) 
            return false;
        return true; 
    }

    public function updatePassword($inputs, AuthValidator $validator)
    {
        $validator->fire($inputs, 'reset_password');

        if($inputs['password'] != $inputs['password_confirmation'])
            throw new ActionForbiddenException('New password and Confirm password does not match');

        $password = $inputs['password'];
        $tokenData = DB::table('password_resets')
            ->where('token', $inputs['token'])->first();

        if(!$tokenData) // if user goes back after resetting password and renters passwrod again
            throw new ActionForbiddenException('This link is either Invalid or Expired');
    
        $user = User::where('email', $tokenData->email)->first();
        if(!$user)
            throw new ActionForbiddenException('Please request another link to reset your password');
        if(Hash::check($inputs['password'], $user->password))
            throw new ActionForbiddenException("Your New Password cannot be same as old password");
    
        $user->password = bcrypt($inputs['password']);
        $user->save();
    
        DB::table('password_resets')->where('email', $user->email)->delete();

        return $inputs;

    }
}