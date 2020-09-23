<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\ProductService;
use App\Transformers\ProductTransformer;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $products;

    /**
     * @param ProductService $products
     */
    public function __construct(
        ProductService $products
    ){
        $this->products = $products;
    }

    /**
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = request()->all();
        $products = $this->products->index($inputs);
        return response()->withMeta($this->getTransformedpaginatedData($products, new ProductTransformer));
    }

    /**
     * @return Illuminate\Http\Response
     */
    public function markInterested($prod_id)
    {
        $inputs = request()->all();
        $this->products->markInterested($prod_id, auth()->user());
        return response()->noContent();
    }

}