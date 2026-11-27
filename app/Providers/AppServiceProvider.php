<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');

            $externalUrl = env('RENDER_EXTERNAL_URL');
            if (is_string($externalUrl) && $externalUrl !== '') {
                URL::forceRootUrl($externalUrl);
            }
        }
    }
}
