<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\BlogService;
use App\Transformers\BlogTransformer;

class BlogController extends Controller
{
    /**
     * @var BlogService
     */
    protected $blogs;

    /**
     * @param BlogService $blogs
     */
    public function __construct(
        BlogService $blogs
    ){
        $this->blogs = $blogs;
    }

    /**
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = request()->all();
        $blogs = $this->blogs->index($inputs);
        return response()->withMeta($this->getTransformedpaginatedData($blogs, new Blogtransformer));
    }

    /**
     * @return Illuminate\Http\Response
     */
    public function get($blog_uuid)
    {
        $inputs = request()->all();
        $blog = $this->blogs->get($inputs, $blog_uuid);
        return response()->success($this->getTransformedData($blog, new Blogtransformer));
    }

}