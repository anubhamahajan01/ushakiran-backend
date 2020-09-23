<?php

namespace App\Exceptions;

use Error;
use Throwable;
use App\Traits\RestTrait;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException as BaseValidationException;

class Handler extends ExceptionHandler
{
    use RestTrait, RestExceptionHandlerTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            return $this->renderForRest($request, $exception);
        } else {
            return $this->renderForWeb($request, $exception);
        }

        return parent::render($request, $exception);
    }

    private function renderForRest($request, $e)
    {
        switch ($e)
        {
            case ($e instanceof ModelNotFoundException):
                return response()->error($e->getMessage(), 404);

            case ($e instanceof NotFoundException):
                return response()->error($e->getMessage(), 404);
            
            case ($e instanceof ActionForbiddenException):
                return response()->error($e->getMessage(), 403);

            case ($e instanceof BaseValidationException):
                return response()->error($e->errors()->toArray(), 422);

            case ($e instanceof Error):
                return response()->error($e->getMessage(), 401);

            case ($e instanceof InvalidCredentialException):
                return response()->error($e->getMessage(), 401);
            
            default:
                return $this->renderRestException($request, $e);
        }
    }

    private function renderForWeb($request, $e)
    {

        switch ($e)
        {
            case ($e instanceof InvalidCredentialsException):
                flash()->error($e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());

            case ($e instanceof ActionForbiddenException):
                flash()->error($e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());

            case ($e instanceof UnauthorizedLoginException):
                return redirect()->route('pages.unauthorized');
            
            default:
                return parent::render($request, $e);
        }
    }
}
