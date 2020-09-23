<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\DonationCategoryRepository;

class DonationCategoryService
{
    /**
     * @var App\Repositories\Contracts\DonationCategoryRepository
     */
    protected $categories;

    /**
     * @param DonationCategoryRepository $categories
     */
    public function __construct(
        DonationCategoryRepository $categories
    ){
        $this->categories = $categories;
    }

    public function index()
    {
        return $this->categories->all();
    }

    public function get($uuid)
    {
        return $this->categories->firstWhere('uuid', $uuid, null, true, 'Donation category');
    }

}