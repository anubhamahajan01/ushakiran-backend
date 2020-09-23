<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Repositories\Contracts\BlogRepository;

class BlogService
{
    /**
     * @var App\Repositories\Contracts\BlogRepository
     */
    protected $blogs;

    /**
     * @param BlogRepository $blogs
     */
    public function __construct(
        BlogRepository $blogs
    ){
        $this->blogs = $blogs;
    }

    public function index($inputs)
    {
        return $this->blogs->index($inputs);
    }

    public function get($inputs, $blog_uuid)
    {
        return $this->blogs->firstWhere('uuid', $blog_uuid, null, true, 'Blog');
    }

}