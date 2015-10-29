<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeSelectServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if (\Request::segment(1)=='admin') {
			\Theme::set('neon-admin');
		}

		if (\Request::segment(1)=='user') {
			\Theme::set('neon-user');
		}

		if (\Request::segment(2)=='register' || \Request::segment(2)=='login') {
			\Theme::set('neon-user');
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
