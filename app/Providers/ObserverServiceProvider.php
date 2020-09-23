<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use App\Models\DonationCategory;
use App\Observers\UserObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\DonationCategoryObserver;

class ObserverServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        User::observe(UserObserver::class);		
		DonationCategory::observe(DonationCategoryObserver::class);
        Product::observe(ProductObserver::class);				
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
}
