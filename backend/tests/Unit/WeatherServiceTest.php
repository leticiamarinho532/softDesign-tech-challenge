<?php

namespace Tests\Unit;

use App\Services\WeatherService;
use App\Interfaces\WeatherApiInterface;
use Tests\TestCase;
use Exception;

class WeatherServiceTest extends TestCase
{
    private $wheatherApi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->wheatherApi = $this->mock(WeatherApiInterface::class);
    }

    public function testShouldListWheaterInfos()
    {
        // Arrange
        $fakeWheater = [
            'locale' => 'São Paulo, SP',
            'temperature' => rand(0,40)
        ];
        $this->wheatherApi
            ->shouldReceive('get')
            ->andReturn($fakeWheater);
        $weatherService = new WeatherService($this->wheatherApi);
        $expectedResult = $fakeWheater;

        // Act
        $result = $weatherService->get($fakeWheater['locale']);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testShouldThrowErrorWhenNotPossibleResturnInfosFromWeather()
    {
        // Arrange
        $fakeWheater = [
            'locale' => 'São Paulo, SP',
            'temperature' => rand(0,40)
        ];
        $this->wheatherApi
            ->shouldReceive('get')
            ->andThrow(new Exception('Expected Exception was thrown'));
        $accountService = new WeatherService($this->wheatherApi);
        
        // Act
        $result = $accountService->get($fakeWheater['locale']);

        // Assert
        $this->assertArrayHasKey('error', $result);
    }
}
