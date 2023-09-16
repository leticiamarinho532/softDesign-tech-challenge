<?php

namespace App\Services;

use App\Interfaces\WeatherApiInterface;
use GuzzleHttp\Client;
use Exception;

class HGWheaterApi implements WeatherApiInterface
{
    public function get($cityName) 
    {
        try {
            $client = new Client();

            $response = $client->request(
                'GET', 
                'https://api.hgbrasil.com/weather?key=' 
                . env('HG_WEATHER_API_KEY') 
                . '&city_name=' 
                . $cityName 
                . '&fields=city_name,temp,ponly_results'
                . 'array_limit=2'
            );

            $formattedResponse = json_decode($response->getBody()->getContents());

            if (isset($formattedResponse->results)) {
                return [
                    'cityName' => $formattedResponse->results->city_name,
                    'temperature' => $formattedResponse->results->temp
                ];
            }

            throw new Exception('API with no results.', 406);
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Não foi listar informações sobre o clima.', 'code' => 406];
        }
    }
}