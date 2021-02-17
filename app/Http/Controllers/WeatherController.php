<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    function index() {
        $response = Http::get('http://api.openweathermap.org/data/2.5/weather', [
            'q' => 'Hanoi',
            'appid' => '02e3323f29bc461c2346db2fe3989729'
        ]);
        $dataJson = json_decode($response->body());
        $temperature = $dataJson->main->temp - 273;
        $weather = $dataJson->weather;
        $weatherType = $weather[0]->main;

        $data = [
            'temperature' => $temperature,
            'weather_type' => $weatherType,
            'city_name' => $dataJson->name
        ];

        return view('home', compact('data'));
    }
}
