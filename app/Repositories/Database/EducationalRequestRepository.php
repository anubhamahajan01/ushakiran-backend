<?php

namespace App\Repositories\Database;

use App\Models\EducationalRequest;
use App\Traits\DatabaseRepositoryTrait;
use App\Repositories\Contracts\EducationalRequestRepository as EducationalRequestRepositoryContract;

class EducationalRequestRepository implements EducationalRequestRepositoryContract
{
    use DatabaseRepositoryTrait;

    protected $model = EducationalRequest::class;
}