<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
        {
            \Log::error('NotFoundHttpException Route: ' . \Request::url() );
            if ($request->expectsJson()) {
                return response()->json(['error' => 'ruta no encontrada.'], 404);
            }
            
        }

        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized.'], 403);
            }
            // TODO: Redirect to error page instead
            // Redirect user from here whatever the route you want.
            return redirect()->route('error');
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
        {
            return response()->json(['error' => 'Entry for '.str_replace('App\\', '', $exception->getModel()).' not found'], 404);
        }
        return parent::render($request, $exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json([
                "error" =>  "invalid_request",
                "message" => "The access token is invalid.",
                "hint" => "Token has expired"
            ], 401)
            : redirect()->guest(route('login'));
    }
}
