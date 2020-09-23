<?php

namespace App\Repositories\Database;

use App\Models\ProductInterest;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\ProductInterestRepository as ProductInterestRepositoryContract;

class ProductInterestRepository implements ProductInterestRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = ProductInterest::class;
}