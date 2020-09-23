<?php

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;


/**
 * Get current dateTime
 * 
 * @return dateTime
 */

function carbon()
{
    return Carbon::now();
}

/**
 * Check if User is logged-in.
 *
 * @return bool
 */
function isLoggedIn()
{
    return auth()->check();
}

/**
 * Get an instance of the logged-in User.
 *
 * @return \App\Models\User|null
 */
function getLoggedInUser()
{
    if(isLoggedIn()) {
        return auth()->user();
    }

    return null;
}

/**
* Generate uuid.
*
* @return string
*/
function generate_uuid()
{
    return Uuid::uuid4()->toString();
}

function subject_title_array($subjets)
{
    $meta = '';

    foreach($subjets as $index => $subject){
        if($index == 0)
            $meta .= $subject->text;
        elseif($index == count($subjets)-1 )
            $meta .= ' and '.$subject->text;
        else
            $meta .= ', '.$subject->text;
    }
    return $meta;
}

function class_title_array($classes)
{
    $meta = '';
    $index = 0;

    foreach($classes as $class){
        if($index == 0)
            $meta .= Arr::get(array_flip(config('settings.educate.classes')), $class);
        elseif($index == count($classes)-1 )
            $meta .= ' and '.Arr::get(array_flip(config('settings.educate.classes')), $class);
        else
            $meta .= ', '.Arr::get(array_flip(config('settings.educate.classes')), $class);
        $index++;
    }
    return $meta;
}