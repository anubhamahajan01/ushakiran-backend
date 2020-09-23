<?php

namespace App\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    protected $users;

    public function __construct(
        AuthService $users
    ) {
        $this->users = $users;
    }

    public function resetPassword($token)
    {

        $inputs = request()->all();
        $validate = $this->users->resetPassword($token);
        if(!$validate)
            flash()->error('FORBIDDEN- *This Link has either expired or is Invalid*');
        return response()->view('auth.passwords.reset', compact('token', 'validate'));
    }

    public function updatePassword()
    {
        $inputs = request()->all();
        $validate = app()->call([$this->users, 'updatePassword'], [
            'inputs'    => $inputs,
        ]);
        return redirect()->route('auth.passwords.success');
     
    }

    public function passwordResetSuccess()
    {
        flash()->success('Password Reset Successful, Login to Continue.');
        return response()->view('auth.passwords.success');   
    }

}
