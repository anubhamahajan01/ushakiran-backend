<?php

namespace App\Providers;

use App\Nova\User;
use App\Nova\Blogs;
use Laravel\Nova\Nova;
use App\Nova\Products;
use App\Nova\Donations;
use Laravel\Nova\Cards\Help;
use App\Nova\InterestedUsers;
use App\Nova\DonationCategory;
use App\Nova\EducationalRequests;
use App\Nova\EducationalSubjects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            if($user->is_admin){
                return true;
            }
            // If user doesn't have access to nova, log them out.
            // This prevents them for being stuck in 403 page.
            Auth::logout();
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            //new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Regoster Nova Resources 
     * 
     * @return void
     */
    protected function resources()
    {
        Nova::resources([
            User::class,
            DonationCategory::class,
            EducationalSubjects::class,
            Donations::class,
            EducationalRequests::class,
            Blogs::class,
            Products::class,
            InterestedUsers::class,
        ]);
    }
}
