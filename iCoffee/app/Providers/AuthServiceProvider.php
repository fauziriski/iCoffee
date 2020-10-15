<?php

namespace App\Providers;


use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdminsuper', function ($user) {
            return $user->hasRole('adminsuper');
        });

        $gate->define('isAdminkeuangan', function ($user) {
            return $user->hasRole('adminkeuangan');
        });

        $gate->define('isAdminweb', function ($user) {
            return $user->hasRole('adminweb');
        });

        $gate->define('isAdminuser', function ($user) {
            return $user->hasRole('adminuser');
        });

    }
}
