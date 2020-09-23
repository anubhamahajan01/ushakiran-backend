<?php

namespace App\Tasks;

use DB;
use Illuminate\Support\Str;
use App\Notifications\PasswordResetNotification;

class SendPasswordResetToken
{
    static public function handle($user)
    {
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Str::random(60),
            'created_at' => carbon()
        ]);
        
        $tokenData = DB::table('password_resets')
            ->where('email', $user->email)
            ->orderBy('created_at', 'DESC')
            ->first();
        
        $token = $tokenData->token;

        $user->notify(new PasswordResetNotification(
            $token
        ));

    }
       
}