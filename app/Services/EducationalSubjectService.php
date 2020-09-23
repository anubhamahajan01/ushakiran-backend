<?php

namespace App\Services;

use App\Repositories\Contracts\EducationalSubjectRepository;

class EducationalSubjectService
{
    /**
     * @var App\Repositories\Contracts\EducationalSubjectRepository
     */
    protected $subjects;

    /**
     * @param EducationalSubjectRepository $subjects
     */
    public function __construct(
        EducationalSubjectRepository $subjects
    ){
        $this->subjects = $subjects;
    }

    public function index()
    {
        return $this->subjects->all();
    }

}