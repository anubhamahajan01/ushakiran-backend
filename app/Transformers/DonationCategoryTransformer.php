<?php

namespace App\Transformers;

use App\Models\DonationCategory;

class DonationCategoryTransformer extends Transformer
{
    public function transform(DonationCategory $category)
    {
        return [
            'id'            => $category->uuid,
            'text'          => (string) $category->text,
            'tooltip'       => (string) $category->tooltip,
            'icon'          => url($category->category_icon_url),
        ];
    }
    
}
