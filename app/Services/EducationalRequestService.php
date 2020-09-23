<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Exceptions\NotFoundException;
use App\Validators\EducationalRequestValidator;
use App\Repositories\Contracts\EducationalRequestRepository;
use App\Repositories\Contracts\EducationalSubjectRepository;

class EducationalRequestService
{
    /**
     * @var App\Repositories\Contracts\EducationalRequestRepository
     */
    protected $requests;
    /**
     * @var App\Repositories\Contracts\EducationalSubjectRepository
     */
    protected $subjects;

    /**
     * @param EducationalRequestRepository $requests
     * @param EducationalSubjectRepository $subjects
     */
    public function __construct(
        EducationalRequestRepository $requests,
        EducationalSubjectRepository $subjects
    ){
        $this->requests = $requests;
        $this->subjects = $subjects;
    }

    public function create($inputs, $user, EducationalRequestValidator $validaor)
    {
        $validaor->fire($inputs, 'create');

        $inputs['class'] = Arr::sort(array_unique($inputs['class']));
        $inputs['subject'] = array_unique($inputs['subject']);
    
        if(array_diff($inputs['class'], config('settings.educate.classes')))
            throw new NotFoundException('Incorrect submission for Classes');

        $subjects = $this->subjects->getWhereIn('uuid', $inputs['subject'], null, false, null, 'created_at', 'ASC');
        if(count($subjects) != count($inputs['subject']))
            throw new NotFoundException('Incorrect submission for Subjects');
        
        app(\App\Tasks\CheckEducationalRequestExist::class)->handle(
            $inputs['class'], $subjects, $user
        );

        $inputs['user_id'] = $user->id;
        $inputs['meta'] = [
            'subjects'  => subject_title_array($subjects),
            'classes'   => class_title_array($inputs['class'])
        ];

        $request = $this->requests->create(Arr::only($inputs, [
                'user_id', 'meta'
            ]));
        
        return $request;
    }

}