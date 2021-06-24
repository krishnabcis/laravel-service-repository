<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            $previous = $e->getPrevious();
        
            if ($previous instanceof AuthorizationException) {
                // assuming ->respondWithError(...) is a private method
                // on your handler
                $response['message'] = "You don't have permission to do this action";
                $response['status'] = 403;
                return response($response, 403);
            }
            
            // let handler follow its course, AccessDeniedHttpException
            // is thrown from other places in the framework
            // unrelated to the Policies flow
            $response['message'] = "Access Denied";
            $response['status'] = 403;
            return response($response, 403);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    /*protected function unauthenticated($request, AccessDeniedHttpException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 403);
        }

        return redirect()->guest(route('login'));
    }*/
}
