<?php

namespace App\Traits;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait RestExceptionHandlerTrait
{
    /**
     * Render an exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function renderRestException(Request $request, Throwable $e)
    {
        switch($e)
        {
            case ($e instanceof HttpResponseException):
                return response()->error($e->getResponse()->getContent(), $e->getResponse()->getStatusCode());
                break;

            case ($e instanceof ModelNotFoundException):
                return response()->error($e->getMessage(), 404);
                break;

            case ($e instanceof AuthenticationException):
                return response()->error('Unauthorized', 401);
                break;

            case ($e instanceof AuthorizationException):
                return response()->error($e->getMessage(), 403);
                break;

            default:
                return $this->convertExceptionToJsonResponse($e);
                break;
        }
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Throwable  $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function convertExceptionToJsonResponse(Throwable $e)
    {
        $e = FlattenException::create($e);

        return response()->error(Arr::get(SymfonyResponse::$statusTexts, $e->getStatusCode()), $e->getStatusCode());
    }
}
