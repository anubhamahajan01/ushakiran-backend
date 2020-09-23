<?php

namespace App\Transformers;

use App\Models\Product;
use App\Transformers\Media\MediaTransformer;

class ProductTransformer extends Transformer
{
     /**
     * List of resource to automatically include
     * 
     * @var array
     */
    protected $defaultIncludes = [
        'images',
    ];

    /**
     * @param App\Models\Product $product
     */
    public function transform(Product $product)
    {
        return [
            'id'            => $product->uuid,
            'title'         => $product->text,
            'description'   => $product->description,
            'price'         => (double) $product->price,
        ];

    }


    public function includeImages(Product $product)
    {
        return $this->collection($product->getMedia('product_image'), new MediaTransformer);
    }
}