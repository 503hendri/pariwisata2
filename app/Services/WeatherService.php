<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public static function current()
    {
        return Cache::remember('weather_sawahlunto', 1800, function () {

            $response = Http::get('https://api.open-meteo.com/v1/forecast', [
                'latitude' => -0.678,
                'longitude' => 100.783,
                'current' => 'temperature_2m,relative_humidity_2m,weathercode',
                'hourly' => 'precipitation_probability',
            ]);

            return [
                'temperature' => $response['current']['temperature_2m'],
                'humidity' => $response['current']['relative_humidity_2m'],
                'weathercode' => $response['current']['weathercode'],
                'rain_probability' => $response['hourly']['precipitation_probability'][0] ?? 0,
            ];

        });
    }

    public static function icon($code)
    {
        return match (true) {
            $code === 0 => '☀️',
            $code <= 3 => '⛅',
            $code <= 48 => '☁️',
            $code <= 67 => '🌧️',
            $code <= 77 => '🌨️',
            $code <= 99 => '⛈️',
            default => '🌤️'
        };
    }

    public static function condition($code)
    {
        return match (true) {

            $code === 0 => 'Cerah',

            $code === 1 => 'Cerah',

            $code === 2 => 'Cerah Berawan',

            $code === 3 => 'Mendung',

            $code >= 45 && $code <= 48 => 'Berkabut',

            $code >= 51 && $code <= 55 => 'Gerimis',

            $code >= 61 && $code <= 67 => 'Hujan',

            $code >= 71 && $code <= 77 => 'Salju',

            $code >= 80 && $code <= 82 => 'Hujan',

            $code >= 95 => 'Badai',

            default => 'Tidak diketahui'
        };
    }
}
