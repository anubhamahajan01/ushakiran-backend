<?php

namespace App\Traits\ForHumanParsers;

use Illuminate\Support\Arr;

trait EducationalRequest
{
    /**
     * Get Class Name 
     */
    public function getClassNameForHumanAttribute()
    {
        return (string) (Arr::get(array_flip(config('settings.educate.classes')), $this->class));
    }
}