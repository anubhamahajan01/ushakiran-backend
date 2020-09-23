<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\AuthService;
use App\Transformers\UserTransformer;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * AuthService intance
     * @var /App/Service/AuthService
     */
    protected $users;

    /**
     * Create auth Controller instance
     * @param App/Services/AuthService $users
     */
    public function __construct(
        AuthService $users
    ){
        $this->users = $users;
    }

    /**
     * handle login request
     * @return Illuminate\Http\Response
     */
    public function login()
    {
       $inputs = request()->all();

       $user = app()->call([$this->users, 'login'], [
            'inputs'    => $inputs,
        ]);

        return response()->success(
            $this->getTransformedData($user, new UserTransformer)
        );
    }

    /**
     * Register new user
     * @return Illuminate\Http\Response
     */
    public function register()
    {
        $inputs = request()->all();

        $user = app()->call([$this->users, 'register'], [
            'inputs'    => $inputs,
        ]);

        return response()->success(
            $this->getTransformedData($user, new UserTransformer), 201
        );
    }

    /**
     * Forgot Password- verify email
     * @return Illuminate\Http\Reponse
     */
    public function verifyEmail()
    {
        $inputs = request()->all();

        $verify = app()->call([$this->users, 'verifyEmail'], [
            'inputs'    => $inputs,
        ]);

        return response()->noContent();
    }

}