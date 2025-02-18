<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\EnsureSubdomain;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::domain('{tenant}.crm.test')
                ->middleware(['web', 'tenant'])
                ->group(base_path('routes/tenant.php'));

            // Main domain routes
            Route::middleware(['web'])
                ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware
            ->group('tenant', [
                NeedsTenant::class,
                EnsureValidTenantSession::class,
            ]);
            // $middleware
            // ->group('tenant', [
            //     \Spatie\Multitenancy\Http\Middleware\NeedsTenant::class,
            //     \Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession::class,
            // ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
