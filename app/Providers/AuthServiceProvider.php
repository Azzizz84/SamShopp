<?php

namespace App\Providers;

 use App\Models\Admin;
 use App\Models\Permission;
 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     */
    public function boot(): void
    {
//        $this->registerPolicies();
//        $permissions = Permission::all();
//        foreach ($permissions as $permission) {
//            Gate::define($permission->key_name, function (Admin $admin) use ($permission) {
//                return $admin->havePermission($permission->key_name);
//            });
//        }

    }
}
