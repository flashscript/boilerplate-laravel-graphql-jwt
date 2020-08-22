<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\QueryException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Throwable;
use HttpResponseException;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException)
            abort(response()->json(['error' => 'MethodNotAllowedHttpException'], 405));
        elseif ($exception instanceof QueryException)
            abort(response()->json(['error' => 'QueryException'], 500));
        elseif ($exception instanceof NotFoundHttpException)
            abort(response()->json(['error' => 'NotFoundHttpException'], 404));
        elseif ($exception instanceof ModelNotFoundException)
            abort(response()->json(['error' => 'ModelNotFoundException'], 404));
        elseif ($exception instanceof \BadMethodCallException)
            abort(response()->json(['error' => 'BadMethodCallException'], 405));
        elseif ($exception instanceof \InvalidArgumentException)
            abort(response()->json(['error' => 'InvalidArgumentException'], 405));
        elseif ($exception instanceof \ErrorException)
            abort(response()->json(['error' => 'ErrorException'], 405));
        elseif ($exception instanceof \ReflectionException)
            abort(response()->json(['error' => 'ReflectionException'], 405));
        elseif ($exception instanceof BindingResolutionException)
            abort(response()->json(['error' => 'BindingResolutionException'], 405));
        elseif ($exception instanceof \ParseError)
            abort(response()->json(['error' => 'ParseError'], 405));
        elseif ($exception instanceof \ArgumentCountError)
            abort(response()->json(['error' => 'ArgumentCountError'], 405));
        elseif ($exception instanceof FatalError)
            abort(response()->json(['error' => 'FatalError'], 500));
        elseif ($exception instanceof \Error)
            abort(response()->json(['error' => 'Error'], 500));
        elseif ($exception instanceof HttpResponseException)
            throw new HttpResponseException("Error");
        elseif ($exception instanceof AuthorizationException)
            throw new AuthorizationException("Unauthorized");


        return parent::render($request, $exception);
    }
}
