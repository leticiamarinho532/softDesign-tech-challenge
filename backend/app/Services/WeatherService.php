<?php

namespace App\Services;

use App\Interfaces\WeatherApiInterface;
use Exception;

class WeatherService
{
    public function __construct(
        private WeatherApiInterface $weatherApi
    )
    {
    }

    public function get($cityName)
    {
        try {
            return $this->weatherApi->get($cityName);
        } catch (Exception $e) {
            return ['error' => true, 'message' => 'Não foi listar informações sobre o clima.', 'code' => 406];
        }
    }
}