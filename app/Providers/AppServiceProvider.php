<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** MAIN **/
        // Position
        $this->app->bind(
            'App\Repositories\PositionRepositoryInterface',
            'App\Repositories\Eloquent\PositionEloquentRepository'
        );

        // User
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserEloquentRepository'
        );

        // Customer
        $this->app->bind(
            'App\Repositories\CustomerRepositoryInterface',
            'App\Repositories\Eloquent\CustomerEloquentRepository'
        );

        // Postage
        $this->app->bind(
            'App\Repositories\PostageRepositoryInterface',
            'App\Repositories\Eloquent\PostageEloquentRepository'
        );

        // Transport
        $this->app->bind(
            'App\Repositories\TransportRepositoryInterface',
            'App\Repositories\Eloquent\TransportEloquentRepository'
        );

        // Garage
        $this->app->bind(
            'App\Repositories\GarageRepositoryInterface',
            'App\Repositories\Eloquent\GarageEloquentRepository'
        );

        // Truck
        $this->app->bind(
            'App\Repositories\TruckRepositoryInterface',
            'App\Repositories\Eloquent\TruckEloquentRepository'
        );

        // Driver
        $this->app->bind(
            'App\Repositories\DriverRepositoryInterface',
            'App\Repositories\Eloquent\DriverEloquentRepository'
        );

        // Oil
        $this->app->bind(
            'App\Repositories\OilRepositoryInterface',
            'App\Repositories\Eloquent\OilEloquentRepository'
        );

        // Lube
        $this->app->bind(
            'App\Repositories\LubeRepositoryInterface',
            'App\Repositories\Eloquent\LubeEloquentRepository'
        );

        // CostOil
        $this->app->bind(
            'App\Repositories\CostOilRepositoryInterface',
            'App\Repositories\Eloquent\CostOilEloquentRepository'
        );

        // CostLube
        $this->app->bind(
            'App\Repositories\CostLubeRepositoryInterface',
            'App\Repositories\Eloquent\CostLubeEloquentRepository'
        );

        // CostPark
        $this->app->bind(
            'App\Repositories\CostParkRepositoryInterface',
            'App\Repositories\Eloquent\CostParkEloquentRepository'
        );

        // CostOther
        $this->app->bind(
            'App\Repositories\CostOtherRepositoryInterface',
            'App\Repositories\Eloquent\CostOtherEloquentRepository'
        );

        // InvoiceCustomer
        $this->app->bind(
            'App\Repositories\InvoiceCustomerRepositoryInterface',
            'App\Repositories\Eloquent\InvoiceCustomerEloquentRepository'
        );

        // InvoiceGarage
        $this->app->bind(
            'App\Repositories\InvoiceGarageRepositoryInterface',
            'App\Repositories\Eloquent\InvoiceGarageEloquentRepository'
        );

        /**  **/

        // GroupRole
        $this->app->bind(
            'App\Repositories\GroupRoleRepositoryInterface',
            'App\Repositories\Eloquent\GroupRoleEloquentRepository'
        );

        // Role
        $this->app->bind(
            'App\Repositories\RoleRepositoryInterface',
            'App\Repositories\Eloquent\RoleEloquentRepository'
        );

        // UserRole
        $this->app->bind(
            'App\Repositories\UserRoleRepositoryInterface',
            'App\Repositories\Eloquent\UserRoleEloquentRepository'
        );

        // UserPosition
        $this->app->bind(
            'App\Repositories\UserPositionRepositoryInterface',
            'App\Repositories\Eloquent\UserPositionEloquentRepository'
        );

        // Voucher
        $this->app->bind(
            'App\Repositories\VoucherRepositoryInterface',
            'App\Repositories\Eloquent\VoucherEloquentRepository'
        );

        // Formula
        $this->app->bind(
            'App\Repositories\FormulaRepositoryInterface',
            'App\Repositories\Eloquent\FormulaEloquentRepository'
        );

        // Product
        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\Eloquent\ProductEloquentRepository'
        );

        // TransportVoucher
        $this->app->bind(
            'App\Repositories\TransportVoucherRepositoryInterface',
            'App\Repositories\Eloquent\TransportVoucherEloquentRepository'
        );

        // TransportFormula
        $this->app->bind(
            'App\Repositories\TransportFormulaRepositoryInterface',
            'App\Repositories\Eloquent\TransportFormulaEloquentRepository'
        );

        // FormulaSample
        $this->app->bind(
            'App\Repositories\FormulaSampleRepositoryInterface',
            'App\Repositories\Eloquent\FormulaSampleEloquentRepository'
        );

        // Unit
        $this->app->bind(
            'App\Repositories\UnitRepositoryInterface',
            'App\Repositories\Eloquent\UnitEloquentRepository'
        );

        // CustomerType
        $this->app->bind(
            'App\Repositories\CustomerTypeRepositoryInterface',
            'App\Repositories\Eloquent\CustomerTypeEloquentRepository'
        );

        // GarageType
        $this->app->bind(
            'App\Repositories\GarageTypeRepositoryInterface',
            'App\Repositories\Eloquent\GarageTypeEloquentRepository'
        );

        // TruckType
        $this->app->bind(
            'App\Repositories\TruckTypeRepositoryInterface',
            'App\Repositories\Eloquent\TruckTypeEloquentRepository'
        );

        // Field
        $this->app->bind(
            'App\Repositories\FieldRepositoryInterface',
            'App\Repositories\Eloquent\FieldEloquentRepository'
        );

        // StaffCustomer
        $this->app->bind(
            'App\Repositories\StaffCustomerRepositoryInterface',
            'App\Repositories\Eloquent\StaffCustomerEloquentRepository'
        );
    }
}
