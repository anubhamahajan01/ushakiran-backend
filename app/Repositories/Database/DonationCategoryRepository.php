<?php

namespace App\Repositories\Database;

use App\Models\DonationCategory;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\DonationCategoryRepository as DonationCategoryRepositoryContract;

class DonationCategoryRepository implements DonationCategoryRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = DonationCategory::class;
}