<?php

namespace App\Providers;

// use App\Models\Permission;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use stdClass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->registerPoliceis();

        // Passport::tokensCan([
        //     'do-anything' => 'Perform any actions',
        // ]);
        //

        // $permission = Permission::all();
        // $object = [];
        // foreach ($permission as $value) {
        //     $object[$value->name] = $value->description;
        // }
        // Passport::tokensCan($object);
        // Passport::tokensCan([
        //     'mi' => 'mikung',
        //     'kung' => 'kung',
        // ]);

        Passport::tokensCan([
            "Read-User" => "Read User",
            "Insert-User" => "Insert User",
            "Update-User" => "Update User",
            "Delete-User" => "Delete User",
            "Read-Organization" => "Read Organization",
            "Insert-Organization" => "Insert Organization",
            "Update-Organization" => "Update Organization",
            "Delete-Organization" => "Delete Organization",
            "Read-Services" => "Read Services",
            "Insert-Services" => "Insert Services",
            "Update-Services" => "Update Services",
            "Delete-Services" => "Delete Services",
            "Read-Room" => "Read Room",
            "Insert-Room" => "Insert Room",
            "Update-Room" => "Update Room",
            "Delete-Room" => "Delete Room",
            "Read-Member" => "Read Member",
            "Insert-Member" => "Insert Member",
            "Update-Member" => "Update Member",
            "Delete-Member" => "Delete Member",
            "Read-Conference" => "Read Conference",
            "Insert-Conference" => "Insert Conference",
            "Update-Conference" => "Update Conference",
            "Delete-Conference" => "Delete Conference"
        ]);

        //
        // Passport::tokensCan([
        //     'place-orders' => 'Place orders',
        //     'check-status' => 'Check order status',
        // ]);
    }
}
