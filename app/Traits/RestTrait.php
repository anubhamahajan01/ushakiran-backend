<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RestTrait
{
    /**
     * Determines if request is an api call.
     *
     * If the request URI contains 'api/'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        logger('isApiCall');
        return $request->is('api/*');
    }

    /**
     * Determines if request is an ajax call.
     *
     * @param Request $request
     * @return bool
     */
    protected function isAjaxCall(Request $request)
    {
        logger('isAjaxCall');
        return $request->expectsJson();
    }
}
