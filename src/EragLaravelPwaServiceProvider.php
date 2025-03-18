<?php

namespace EragLaravelPwa;

use EragLaravelPwa\Commands\PWACommand;
use EragLaravelPwa\Commands\PwaPublishCommand;
use EragLaravelPwa\Services\PWAService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class EragLaravelPwaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PWAService::class, function ($app) {
            return new PWAService();
        });

        $this->app->alias(PWAService::class, 'pwa');

        $this->commands([
            PwaPublishCommand::class,
            PWACommand::class,
        ]);

        $this->publishes([
            __DIR__.'/Stubs/pwa.stub' => config_path('pwa.php'),
        ], 'erag:publish-pwa-config');

        $this->publishes([
            __DIR__.'/Stubs/manifest.stub' => public_path('manifest.json'),
        ], 'erag:publish-manifest');

        $this->publishes([
            __DIR__.'/Stubs/offline.stub' => public_path('offline.html'),
        ], 'erag:publish-offline');

        $this->publishes([
            __DIR__.'/Stubs/sw.stub' => public_path('sw.js'),
        ], 'erag:publish-sw');

        $this->publishes([
            __DIR__.'/Stubs/logo.png' => public_path('logo.png'),
        ], 'erag:publish-logo');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishResources();

        $this->registerBladeDirectives();
    }

    /**
     * Publish package resources.
     */
    private function publishResources(): void
    {
        $this->publishes([
            __DIR__.'/Stubs/pwa.stub' => config_path('pwa.php'),
        ], 'erag:publish-pwa-config');

        $this->publishes([
            __DIR__.'/Stubs/manifest.stub' => public_path('manifest.json'),
        ], 'erag:publish-manifest');

        $this->publishes([
            __DIR__.'/Stubs/offline.stub' => public_path('offline.html'),
        ], 'erag:publish-offline');

        $this->publishes([
            __DIR__.'/Stubs/sw.stub' => public_path('sw.js'),
        ], 'erag:publish-sw');

        $this->publishes([
            __DIR__.'/Stubs/logo.png' => public_path('logo.png'),
        ], 'erag:publish-logo');
    }

    /**
     * Register Blade directives.
     */
    private function registerBladeDirectives(): void
    {
        Blade::directive('PwaHead', function () {
            return '<?php echo app(\\EragLaravelPwa\\Services\\PWAService::class)->headTag(); ?>';
        });

        Blade::directive('RegisterServiceWorkerScript', function () {
            return '<?php echo app(\\EragLaravelPwa\\Services\\PWAService::class)->registerServiceWorkerScript(); ?>';
        });
    }
}
