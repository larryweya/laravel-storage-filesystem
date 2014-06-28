<?php namespace Laravel\Storage;

use Illuminate\Support\ServiceProvider;

class FilesystemStorageServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('storage', function() {
            return new FilesystemStorage(
                $this->app['files'],
                $this->app['config']->get('storage.upload_dir'),
                $this->app['config']->get('storage.upload_root_url'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('storage');
    }

}
