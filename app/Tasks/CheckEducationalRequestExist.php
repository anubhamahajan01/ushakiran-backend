<?php

namespace App\Tasks;

use DB;
use Illuminate\Support\Str;
use App\Models\EducationalRequest;
use App\Exceptions\ActionForbiddenException;

class CheckEducationalRequestExist
{
    static public function handle($class, $subjects, $user)
    {
        $exists = EducationalRequest::where('meta->classes', class_title_array($class))
            ->where('meta->subjects', subject_title_array($subjects))
            ->where('user_id', $user->id)
            ->whereDate('created_at', carbon()->today())
            ->get();

        if(count($exists))
            throw new ActionForbiddenException("More than one request for similar categories are not allowed on the same day.");

        return;
    }       
}