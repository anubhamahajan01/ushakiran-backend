<?php

namespace App\Transformers\Media;

use App\Transformers\Transformer;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaTransformer extends Transformer
{
    /**
     * @param MediaTransformer $media
     * @return array
     */
    public function transform(Media $media)
    {
        $data = [
            'url'   => $media->getUrl(),
        ];
    
        return $data;
    }
}