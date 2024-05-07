<?php

//use App\Http\Middleware\AdminRedirect;
use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
//use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\EnsureTokenIsValid;
use Spatie\Permission\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            //'admin.guest' => AdminRedirect::class,
            //'admin.auth' => AdminAuthenticate::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
            'isAdmin' => AdminMiddleware::class
        ]);
        
        $middleware->redirectTo(
            guests: '/account/login',
            users: '/account/dashboard'
        );

   
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
