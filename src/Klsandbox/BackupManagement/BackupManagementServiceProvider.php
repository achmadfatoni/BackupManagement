<?php namespace Klsandbox\BackupManagement;

use Illuminate\Support\ServiceProvider;
use Klsandbox\BackupManagement\Console\Commands\BackupStart;

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
	public function register() {
		$this->app->singleton('command.klsandbox.backupstart', function($app) {
			return new BackupStart();
		});

		$this->commands('command.klsandbox.backupstart');
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
		$this->loadViewsFrom(__DIR__ . '/../../../views/', 'backup-management');

		if (! $this->app->routesAreCached()) {
			require __DIR__ . '/../../../routes/routes.php';
		}

		$this->publishes([
			__DIR__ . '/../../../views/' => base_path('resources/views/vendor/backup-management')
		], 'views');

		$this->publishes([
			__DIR__ . '/../../../database/migrations/' => database_path('/migrations')
		], 'migrations');
	}
}
