<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer extends Transformer
{
    public function transform(User $user)
    {
        return [
            'id'            => (string) $user->uuid,
            'name'          => (string) $user->name,
            'email'         => (string) $user->email,
            'phone'         => $user->phone,
            'address'       => (string) $user->address,
            'token'         => $user->token ? $user->token : null,
        ];
    }
    
}
