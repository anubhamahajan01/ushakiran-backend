<?php

namespace App\Repositories\Database;

use App\Models\Blog;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\BlogRepository as BlogRepositoryContract;

class BlogRepository implements BlogRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = Blog::class;

    public function index($inputs)
    {
        $query = $this->query();

        $query->where('is_live', true);
        
        return $query->orderBy('created_at', 'DESC')
            ->paginate(20);
    }
}