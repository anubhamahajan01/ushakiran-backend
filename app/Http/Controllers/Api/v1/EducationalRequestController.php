<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\EducationalRequestService;
use App\Transformers\EducationalRequestTransformer;

class EducationalRequestController extends Controller
{
    /**
     * @var App\Services\EducationalRequestService
     */
    protected $requests;

    /**
     * @param EducationalRequestService $requests
     */
    public function __construct(
        EducationalRequestService $requests
    ){
        $this->requests = $requests;
    }

    /**
     *  @return Illuminate\Http\Response
     */
    public function create()
    {
        $inputs = request()->all();

        $request = app()->call([$this->requests, 'create'], [
            'inputs'    => $inputs,
            'user'      => auth()->user(),
        ]);

        return response()->success($this->getTransformedData($request, new EducationalRequestTransformer));
    }
}