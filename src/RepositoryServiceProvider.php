<?php
/**
 * Created by PhpStorm
 * User: khanh
 * Date: 10/7/19
 * Time: 2:20 PM
 */

namespace Iamnvk\Repository;

use Iamnvk\Repository\Commands\Creators\CriteriaCreator;
use Iamnvk\Repository\Commands\Creators\RepositoryCreator;
use Iamnvk\Repository\Commands\CriteriaCommand;
use Iamnvk\Repository\Commands\RepositoryCommand;
use Illuminate\Support\Composer;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config path.
        $config_path = __DIR__ . '/../configs/repositories.php';
        // Publish config.
        $this->publishes(
            [$config_path => config_path('repositories.php')],
            'repositories'
        );
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register bindings.
        $this->registerBindings();
        // Register make repository command.
        $this->registerMakeRepositoryCommand();
        // Register make criteria command.
        $this->registerMakeCriteriaCommand();
        // Register commands
        $this->commands(['command.repository.make', 'command.criteria.make']);
        // Config path.
        $config_path = __DIR__ . '/../configs/repositories.php';
        // Merge config.
        $this->mergeConfigFrom(
            $config_path,
            'repositories'
        );
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        // FileSystem.
        $this->app->instance('FileSystem', new Filesystem());
        // Composer.
        $this->app->bind('Composer', function ($app)
        {
            return new Composer($app['FileSystem']);
        });
        // Repository creator.
        $this->app->singleton('RepositoryCreator', function ($app)
        {
            return new RepositoryCreator($app['FileSystem']);
        });
        // Criteria creator.
        $this->app->singleton('CriteriaCreator', function ($app)
        {
            return new CriteriaCreator($app['FileSystem']);
        });
    }

    /**
     * Register the make:repository command.
     */
    protected function registerMakeRepositoryCommand()
    {
        // Make repository command.
        $this->app['command.repository.make'] = $this->app->share(
            function($app)
            {
                return new RepositoryCommand($app['RepositoryCreator']);
            }
        );
    }

    /**
     * Register the make:criteria command.
     */
    protected function registerMakeCriteriaCommand()
    {
        // Make criteria command.
        $this->app['command.criteria.make'] = $this->app->share(
            function($app)
            {
                return new CriteriaCommand($app['CriteriaCreator']);
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.repository.make',
            'command.criteria.make'
        ];
    }
}
