<?php

namespace App\Repositories\Database;

use App\Models\Donation;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\DonationRepository as DonationRepositoryContract;

class DonationRepository implements DonationRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = Donation::class;
}