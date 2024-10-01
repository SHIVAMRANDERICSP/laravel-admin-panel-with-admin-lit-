<?php

namespace App\Http\Controllers;

use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $ip = '103.226.226.86'; //For static IP address get
        // $ip = request()->ip(); //Dynamic IP address get
        $data = Location::get($ip);
        // dd($data);
        $url = 'https://api.weatherapi.com/v1/current.json';
        $apiKey = '20a23b1e5f754d35a05110334243009'; // Consider using environment variables for sensitive data
        $location = 'surat';
        try {
            $response = Http::get($url, [
                'key' => $apiKey,
                'q' => $location,
                'aqi' => 'yes'
            ]);

            if ($response->successful()) {
                $response = json_decode($response);
                // dd($response->location->name);
                return view('admin.weather.index', compact('response'));
            } else {
                $response = response()->json([
                    'error' => 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason()
                ], $response->status());
                return view('admin.weather.index');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function getweather(Request $request)
    {
        $url = 'https://api.weatherapi.com/v1/current.json';
        $apiKey = '20a23b1e5f754d35a05110334243009'; // Consider using environment variables for sensitive data
        $location =  $request->name;
        try {
            $response = Http::get($url, [
                'key' => $apiKey,
                'q' => $location,
                'aqi' => 'yes'
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'error' => 'Unexpected HTTP status: ' . $response->status() . ' ' . $response->reason()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
