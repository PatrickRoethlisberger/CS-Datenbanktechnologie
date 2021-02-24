<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
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

        /**
         * Check policies
         */

         Gate::define('create-application', function(User $user) {
             return $user->checks == null
                ? Response::allow()
                : Response::deny();
         });

        /**
         * Order policies
         */

        Gate::define('create-order', function(User $user) {
            return empty(! $user->roles)
                ?   ( $user->roles->contains("validated")
                    ? Response::allow()
                    : Response::deny()
                    )
                : Response::deny();
        });

        Gate::define('create-trial-order', function(User $user) {
            return $user->lastOrder()
                    ?   ( $user->lastOrder()->plan()->first()->isTerminatingPlan
                        ? ( $user->currentOrder() != null
                            ? Response::allow()
                            : Response::deny()
                            )
                        : Response::deny()
                        )
                    :   Response::allow();
        });

        Gate::define('create-full-order', function(User $user) {
            return $user->lastOrder()
                ?   ( $user->lastOrder()->plan()->first()->isTerminatingPlan
                    ? Response::deny()
                    :  (  !($user->lastOrder()->plan()->first()->isInitialPlan) || $user->lastOrder()->until <= Carbon::now()
                        ? Response::allow()
                        : Response::deny()
                        // ToDo: Check for Audits
                        )
                    )
                : Response::deny();
        });
    }
}
