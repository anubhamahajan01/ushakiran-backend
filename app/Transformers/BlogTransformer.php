<?php

namespace App\Transformers;

use App\Models\Blog;

class BlogTransformer extends Transformer
{
    /**
     * @param App\Models\Blog $blog
     */
    public function transform(Blog $blog)
    {
        return [
            'id'            => $blog->uuid,
            'title'         => $blog->title,
            'description'   => $blog->description,
            'posted_at'     => (string) $blog->created_at->diffForHumans(),
        ];

    }
}