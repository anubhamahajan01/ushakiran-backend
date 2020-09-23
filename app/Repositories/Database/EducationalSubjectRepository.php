<?php

namespace App\Repositories\Database;

use App\Models\EducationalSubject;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\EducationalSubjectRepository as EducationalSubjectRepositoryContract;

class EducationalSubjectRepository implements EducationalSubjectRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = EducationalSubject::class;
}