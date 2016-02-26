<?php namespace Klsandbox\BackupManagement;

use Illuminate\Support\ServiceProvider;

class BackupManagementServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

	public function boot() {
		$this->loadViewsFrom(__DIR__.'/views', 'backup-management');

		$this->publishes([
			__DIR__ . '/../../../views/' => base_path('resources/views')
		], 'views');

		$this->publishes([
			__DIR__ . '/../../../database/migrations/' => database_path('/migrations')
		], 'migrations');
	}
}
