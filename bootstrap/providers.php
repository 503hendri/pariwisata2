<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\WeatherService;
use App\Providers\WebsiteProfileServiceProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    WeatherService::class,
    WebsiteProfileServiceProvider::class,
];
