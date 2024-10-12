<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->renderCustomErrorPage($e);
    }

    /**
     * Render a custom error page.
     *
     * @param  \Throwable  $e
     * @return \Illuminate\Http\Response
     */
    protected function renderCustomErrorPage(Throwable $e)
    {
        $statusCode = 500;

        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }

        if (view()->exists("errors.{$statusCode}")) {
            return response()->view("errors.{$statusCode}", ['exception' => $e], $statusCode);
        }

        return response()->view('errors.500', ['exception' => $e], 500);
    }
}
