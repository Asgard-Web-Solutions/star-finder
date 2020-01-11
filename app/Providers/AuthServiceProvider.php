<?php

namespace App\Providers;

use App\Role;
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

        Gate::define('view-acp', function ($user) {
            return $this->isAdmin($user);
        });

        Gate::define('view-acp-users', function ($user) {
            return $this->isAdmin($user);
        });

        Gate::define('manage-roles', function ($user) {
            return $this->isAdmin($user);
        });

        Gate::define('view-profile', function ($user, $profile) {
            if ($user->id == $profile) {
                return true;
            }

            if ($this->isAdmin($user)) {
                return true;
            }

            return true;
        });

        Gate::define('edit-profile', function ($user, $profile) {
            if ($user->id == $profile) {
                return true;
            }

            if ($this->isAdmin($user)) {
                return true;
            }

            return false;
        });

        Gate::define('view-pii', function ($user, $profile) {
            if ($user->id == $profile) {
                return true;
            }

            if ($this->isAdmin($user)) {
                return true;
            }

            return false;
        });
    }

    private function isAdmin($user) {
        $admin = Role::where('name', '=', 'Admin')->first();
        return $user->roles->contains($admin);
    }
}
