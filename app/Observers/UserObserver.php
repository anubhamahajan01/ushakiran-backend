<?php

namespace App\Observers;

use App\Models\User;
use App\Exceptions\ActionForbiddenException;

class UserObserver
{
     /**
     * Handle the User "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        if($user->id == getLoggedInUser()->id)
            throw new ActionForbiddenException('You are currently logged in');
            
        $user->educational_request()->delete();
        $user->donations()->delete();
        $user->shop_interests()->delete();
    }

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        //
    }
}