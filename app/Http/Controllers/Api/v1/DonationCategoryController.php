<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\DonationCategoryService;
use App\Transformers\DonationCategoryTransformer;

class DonationCategoryController extends Controller
{
    /**
     * @var App\Services\DonationCategoryService
     */
    protected $categories;

    /**
     * @param DonationCategoryService $categories
     */
    public function __construct(
        DonationCategoryService $categories
    ){
        $this->categories = $categories;
    }

    /**
     * List categories
     *  @return Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = request()->all();
        $categories = $this->categories->index();
        return response()->success($this->getTransformedData($categories, new DonationCategoryTransformer));
    }

    /**
     * Get category
     *  @return Illuminate\Http\Response 
     */
    public function get($uuid)
    {
        $inputs = request()->all();
        $category = $this->categories->get($uuid);
        return response()->success($this->getTransformedData($category, new DonationCategoryTransformer));
    }
}