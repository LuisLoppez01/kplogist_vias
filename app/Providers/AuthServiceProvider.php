<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Policies\DeleteDataPolicy;
use App\Policies\RouteAccessPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        Gate::define('view', [RouteAccessPolicy::class, 'view']);
        Gate::define('create', [RouteAccessPolicy::class, 'create']);
        Gate::define('update', [RouteAccessPolicy::class, 'update']);
        Gate::define('edit', [RouteAccessPolicy::class, 'edit']);
        Gate::define('delete', [RouteAccessPolicy::class, 'delete']);

    }
}
