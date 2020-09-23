<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
     /**
     * Handle the Product "deleting" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleting(Product $product)
    {       
        $product->shop_interests()->delete();
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        //
    }
}