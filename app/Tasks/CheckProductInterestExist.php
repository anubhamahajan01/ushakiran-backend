<?php

namespace App\Tasks;

use DB;
use Illuminate\Support\Str;
use App\Models\ProductInterest;
use App\Exceptions\ActionForbiddenException;

class CheckProductInterestExist
{
    static public function handle($user, $product)
    {
        $exists = ProductInterest::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->whereDate('created_at', carbon()->today())
            ->get();

        if(count($exists))
            throw new ActionForbiddenException("Your interest in this product has already been recorded, try again tomorrow.");

        return;
    }       
}