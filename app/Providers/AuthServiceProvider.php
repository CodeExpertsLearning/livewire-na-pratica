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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('check.user.is.admin', function($user) {
            return $user->isAdmin();
        });

        Gate::define('check.user.can.edit.expense', function($user, $expense) {
            return $user->expenses->contains($expense);
            //return $user->id == $expense->user_id;
        });
    }
}
