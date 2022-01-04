<?php
declare(strict_types=1);

namespace App\DTO;

/**
 *  Abstract Class CurrentWeather
 */
abstract class CurrentWeather
{
    /**
     * Temperature
     * @var float
     */
    public float $temp;

    /**
     * Overall weather
     * @var string
     */
    public string $weather;

    /**
     * Weather description
     * @var string
     */
    public string $description;

    /**
     * Weather icon code
     * @var string
     */
    public string $icon;

    /**
     * Humidity
     * @var int
     */
    public int $humidity;

    /**
     * Wind speed
     * @var float
     */
    public float $windSpeed;

    /**
     * Wind Direction
     * @var string
     */
    public string $windDirection;

    /**
     * Pressure
     * @var int
     */
    public int $pressure;

    /**
     * All clouds
     * @var int
     */
    public int $clouds;

    /**
     * Transform the given array to CurrentWeather object
     * @param array $data
     * @return CurrentWeather
     */
    abstract public static function transform(array $data): CurrentWeather;
}
