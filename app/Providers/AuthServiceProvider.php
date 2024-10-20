<?php

namespace App\Providers;

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
    public function boot()
    {
        $this->registerPolicies();

        // Definir uma Gate para cada ação
        Gate::define('view_users', function (User $user) {
            return $user->hasPermission('view_users');
        });

        Gate::define('modify_users', function (User $user) {
            return $user->hasPermission('modify_users');
        });

        Gate::define('delete_users', function (User $user) {
            return $user->hasPermission('delete_users');
        });

        Gate::define('view_roles', function (User $user) {
            return $user->hasPermission('view_roles');
        });

        Gate::define('modify_roles', function (User $user) {
            return $user->hasPermission('modify_roles');
        });
    }
}
