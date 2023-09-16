<?php

namespace App\Interfaces;

interface WeatherApiInterface
{
    public function get($cityName);
}