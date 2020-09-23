<?php

namespace App\Repositories\Database;

use App\Models\Product;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\ProductRepository as ProdcutRepositoryContract;

class ProductRepository implements ProdcutRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = Product::class;

    public function index($inputs)
    {
        $query = $this->query();

        return $query->orderBy('created_at', 'DESC')
            ->paginate(20);
    }
}