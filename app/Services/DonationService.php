<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Validators\DonationValidator;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\DonationRepository;
use App\Repositories\Contracts\DonationCategoryRepository;

class DonationService
{
    /**
     * @var App\Repositories\Contracts\DonationRepository
     */
    protected $donations;
    /**
     * @var App\Repositories\Contracts\DonationCategoryRepository
     */
    protected $categories;

    /**
     * @param DonationRepository $donations
     * @param DonationCategoryRepository $categories
     */
    public function __construct(
        DonationRepository $donations,
        DonationCategoryRepository $categories
    ){
        $this->donations = $donations;
        $this->categories  = $categories;
    }

    public function create($inputs, $user, DonationValidator $validator)
    {
        $validator->fire($inputs, 'field_verify_create');

        $category = $this->categories->firstWhere('uuid', Arr::get($inputs, 'donation_category_id'), null, true, 'Donation category');

        $inputs['donation_category_id'] = $category->id;
        $inputs['user_id'] = $user->id;
        
        $validator->fire($inputs, 'create');

        $donation = $this->donations->create(Arr::only($inputs, [
            'donation_category_id', 'user_id', 'details'
        ]));
        return $donation;
    }

}