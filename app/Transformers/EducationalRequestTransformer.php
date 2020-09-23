<?php

namespace App\Transformers;

use App\Models\EducationalRequest;

class EducationalRequestTransformer extends Transformer
{
    public function transform(EducationalRequest $request)
    {
        return [
            'requestee'     => $request->user->name,
            'subjects'      => $request->meta['subjects'],
            'classes'       => $request->meta['classes'],
        ];
    }
    
}
