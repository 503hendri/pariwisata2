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

require __DIR__.'/settings.php';
