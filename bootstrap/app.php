<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {
            $isExpiredSession = $e instanceof TokenMismatchException
                || ($e instanceof HttpException && $e->getStatusCode() === 419);

            if (! $isExpiredSession) {
                return null;
            }

            if ($request->is('login') || $request->routeIs('login')) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Sesi habis. Muat ulang halaman login lalu coba masuk lagi.');
            }

            if ($request->is('krs/store') || $request->routeIs('krs.store')) {
                return redirect('/krs')
                    ->with('error', 'Sesi habis. Muat ulang halaman KRS (Ctrl+F5) lalu coba ajukan lagi.');
            }

            return redirect()
                ->back()
                ->withInput($request->except('_token', 'password'))
                ->with('error', 'Sesi habis. Silakan muat ulang halaman dan coba lagi.');
        });
    })->create();
