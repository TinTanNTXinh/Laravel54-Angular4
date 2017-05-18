<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Barryvdh\Cors\HandleCors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'               => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'         => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'           => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'                => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'              => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'           => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth'           => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh'        => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'iocenter'           => \App\Http\Middleware\IOCenter::class,
        'device'             => \App\Http\Middleware\Device::class,
        'supplier'           => \App\Http\Middleware\Supplier::class,
        'distributor'        => \App\Http\Middleware\Distributor::class,
        'user'               => \App\Http\Middleware\User::class,
        'product'            => \App\Http\Middleware\Product::class,
        'producer'           => \App\Http\Middleware\Producer::class,
        'unit'               => \App\Http\Middleware\Unit::class,
        'position'           => \App\Http\Middleware\Position::class,
        'button-product'     => \App\Http\Middleware\ButtonProduct::class,
        'user-card'          => \App\Http\Middleware\UserCard::class,
        'report-supplier'    => \App\Http\Middleware\ReportSupplier::class,
        'report-distributor' => \App\Http\Middleware\ReportDistributor::class,
        'report-staff-input' => \App\Http\Middleware\ReportStaffInput::class,
        'report-vsys'        => \App\Http\Middleware\ReportVsys::class,
        'report-logging'     => \App\Http\Middleware\ReportLogging::class
    ];
}
