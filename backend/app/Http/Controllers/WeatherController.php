<?php

namespace App\Http\Controllers;

use App\Services\HGWheaterApi;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    public function __construct(
        private HGWheaterApi $weatherApi
    )
    { 
    }

    public function show($cityName)
    {
        $weatherService = new WeatherService($this->weatherApi);

        $result = $weatherService->get($cityName);

        if (is_array($result) && in_array('error', $result)) {
            return response()->json([
                'message' => $result['message']
            ], $result['code']);
        }

        return response()->json($result, 200);
    }
}
