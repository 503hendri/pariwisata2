<?php

use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome')->name('home');
Route::livewire('/', 'home')->name('home');
// Route::livewire('/home2', 'home2')->name('home2');
Route::livewire('/destinations', 'destination.index')->name('destination.index');
Route::livewire('/destinations/{slug}', 'destination.show')->name('destination.show');

Route::livewire('/accomodations', 'acomodation.index')->name('acomodation.index');
Route::livewire('/accomodations/{slug}', 'acomodation.show')->name('acomodation.show');

Route::livewire('/culinaries', 'culinary.index')->name('culinary.index');
Route::livewire('/culinaries/{slug}', 'culinary.show')->name('culinary.show');

Route::livewire('/news', 'news.index')->name('news.index');
Route::livewire('/news/{slug}', 'news.show')->name('news.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('dashboard', 'admin.dashboard')->name('dashboard');
    Route::livewire('admin/destinations', 'admin.destination.index')->name('admin.destinations.index');
    Route::livewire('admin/destinations/create/{destinationId?}', 'admin.destination.create')->name('admin.destinations.create');
    Route::livewire('admin/events', 'admin.event')->name('admin.events');
    Route::livewire('admin/culinaries', 'admin.culinary')->name('admin.culinaries');
    Route::livewire('admin/accomodations', 'admin.accomodation')->name('admin.accomodations');
    Route::livewire('admin/news', 'admin.news.index')->name('admin.news');
    Route::livewire('admin/news/create/{slug?}', 'admin.news.create')->name('admin.news.create');
    Route::livewire('admin/profile', 'admin.profile')->name('admin.profile');
});

Route::get('/debug-proxy', function (Request $request) {
    return response()->json([
        'url' => $request->url(),
        'full_url' => $request->fullUrl(),

        'scheme' => $request->getScheme(),
        'is_secure' => $request->isSecure(),

        'host' => $request->getHost(),
        'port' => $request->getPort(),

        'http_host' => $request->header('Host'),
        'x_forwarded_for' => $request->header('X-Forwarded-For'),
        'x_forwarded_host' => $request->header('X-Forwarded-Host'),
        'x_forwarded_proto' => $request->header('X-Forwarded-Proto'),
        'x_forwarded_port' => $request->header('X-Forwarded-Port'),

        'app_url' => config('app.url'),
    ]);
});

require __DIR__.'/settings.php';
