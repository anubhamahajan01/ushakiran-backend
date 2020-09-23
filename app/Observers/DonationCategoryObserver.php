<?php

namespace App\Observers;

use App\Models\DonationCategory;
use App\Exceptions\ActionForbiddenException;

class DonationCategoryObserver
{
     /**
     * Handle the DonationCategory "deleting" event.
     *
     * @param  \App\Models\DonationCategory  $category
     * @return void
     */
    public function deleting(DonationCategory $category)
    {
        //
    }

    /**
     * Handle the DonationCategory "updating" event.
     *
     * @param  \App\Models\DonationCategory  $category
     * @return void
     */
    public function updating(DonationCategory $category)
    {
        //
    }
}