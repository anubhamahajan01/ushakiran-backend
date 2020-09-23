<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\UserRepository::class,
            \App\Repositories\Database\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\DonationCategoryRepository::class,
            \App\Repositories\Database\DonationCategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\DonationRepository::class,
            \App\Repositories\Database\DonationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\EducationalSubjectRepository::class,
            \App\Repositories\Database\EducationalSubjectRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\EducationalRequestRepository::class,
            \App\Repositories\Database\EducationalRequestRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ProductRepository::class,
            \App\Repositories\Database\ProductRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\BlogRepository::class,
            \App\Repositories\Database\BlogRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ProductInterestRepository::class,
            \App\Repositories\Database\ProductInterestRepository::class
        );
    }
}
