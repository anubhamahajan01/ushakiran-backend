<?php

namespace App\Http\Controllers\Api\v1;

use App\Services\EducationalSubjectService;
use App\Transformers\EducationalSubjectTransformer;

class EducationalSubjectController extends Controller
{
    /**
     * @var App\Services\EducationalSubjectService
     */
    protected $subjects;

    /**
     * @param EducationalSubjectService $subjects
     */
    public function __construct(
        EducationalSubjectService $subjects
    ){
        $this->subjects = $subjects;
    }

    /**
     * List subjects
     *  @return Illuminate\Http\Response
     */
    public function index()
    {
        $inputs = request()->all();
        $subjects = $this->subjects->index();
        return response()->success($this->getTransformedData($subjects, new EducationalSubjectTransformer));
    }
}