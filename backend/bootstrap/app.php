<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Exception $e, Request $request) {
            if (request()->is('api/*')) {
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'success' => false,
                        'error' => 401,
                        'message' => $e->getMessage(),
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'error' => $e->statusCode ?? 500,
                        'message' => $e->getMessage() . '| Line: ' . $e->getLine() . '| File: ' . $e->getFile(),
                    ]);
                }
            }
        });
    })->create();
