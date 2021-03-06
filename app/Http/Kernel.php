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
        'auth'             => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'         => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'              => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'            => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'         => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth'         => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh'      => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'position'         => \App\Http\Middleware\Position::class,
        'user'             => \App\Http\Middleware\User::class,
        'driver'           => \App\Http\Middleware\Driver::class,
        'truck'            => \App\Http\Middleware\Truck::class,
        'customer'         => \App\Http\Middleware\Customer::class,
        'staff-customer'   => \App\Http\Middleware\StaffCustomer::class,
        'transport'        => \App\Http\Middleware\Transport::class,
        'garage'           => \App\Http\Middleware\Garage::class,
        'invoice-customer' => \App\Http\Middleware\InvoiceCustomer::class,
        'invoice-garage'   => \App\Http\Middleware\InvoiceGarage::class,
        'cost-oil'         => \App\Http\Middleware\CostOil::class,
        'cost-lube'        => \App\Http\Middleware\CostLube::class,
        'cost-parking'     => \App\Http\Middleware\CostParking::class,
        'cost-other'       => \App\Http\Middleware\CostOther::class,
        'postage'          => \App\Http\Middleware\Postage::class,
        'oil'              => \App\Http\Middleware\Oil::class,
        'lube'             => \App\Http\Middleware\Lube::class,
        'report'           => \App\Http\Middleware\Report::class
    ];
}
