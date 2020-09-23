<?php

namespace App\Transformers;

use App\Models\Donation;

class DonationTransformer extends Transformer
{
    public function transform(Donation $donation)
    {
        return [
            'name'          => (string) $donation->user->name,
            'category'      => (string) $donation->donation_category->text,
            'details'       => (string) $donation->details,
        ];
    }
    
}
