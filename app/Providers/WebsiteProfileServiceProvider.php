<?php

namespace App\Providers;

use App\Models\WebsiteProfile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WebsiteProfileServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $resolver = function () {
            try {
                return WebsiteProfile::query()->first();
            } catch (\Throwable $e) {
                return null;
            }
        };

        View::composer(['layouts.guest', 'layouts.app'], function ($view) use ($resolver) {
            $view->with('websiteProfile', $resolver());
        });
    }
}
