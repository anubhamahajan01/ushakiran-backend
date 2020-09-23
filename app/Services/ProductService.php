<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Exceptions\ActionForbiddenException;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\ProductInterestRepository;

class ProductService
{
    /**
     * @var App\Repositories\Contracts\ProductRepository
     */
    protected $products;

    /**
     * @var App\Repositories\Contracts\ProductInterestRepository
     */
    protected $interests;

    /**
     * @param ProductRepository $products
     * @param ProductInterestRepository $interests 
     */
    public function __construct(
        ProductRepository $products,
        ProductInterestRepository $interests
    ){
        $this->products = $products;
        $this->interests = $interests;
    }

    public function index($inputs)
    {
        return $this->products->index($inputs);
    }

    public function markInterested($prod_id, $user)
    {
        $product = $this->products->firstWhere('uuid', $prod_id, null, true, 'Product');

        app(\App\Tasks\CheckProductInterestExist::class)->handle(
            $user, $product
        );
            
        $this->interests->create([
            'user_id'       => $user->id,
            'product_id'    => $product->id,
        ]);
        return;
    }

}