<?php

namespace App\Validators;

class AuthValidator extends Validator
{
    /**
     * @param array $data
     * @param String $type
     * @return array
     */
    protected function rules($data, $type)
    {
        $rules = [];

        switch ($type) {
            case 'login':
                $rules = [
                    'email'     => 'required|email',
                    'password'  => 'required|min:6|max:100',
                ];
                break;
            
            case 'register':
                $rules = [
                    'name'      => 'required|string|min:3|max:50|regex:/^[a-zA-Z\s]*$/',
                    'email'     => 'required|email|unique:users',
                    'password'  => 'required|min:6|max:100',
                    'phone'     => 'required|digits:10|unique:users,phone',
                    'address'   => 'required|min:6|max:250',
                ];
                break;
            
            case 'verify_email':
                $rules = [
                    'email'     => 'required|email',
                ];
                break;
            
            case 'reset_password':
                $rules = [
                    'password'              => 'required|min:6|max:100',
                    'password_confirmation' => 'required|min:6|max:100',
                ];
                break;
            
            default:
                break;
        }
        return $rules;
    }
}
