<?php
declare(strict_types=1);

namespace App\DTO;

/**
 * Class OpenWeatherCWDTO
 */
final class OpenWeatherCWDTO extends CurrentWeather
{
    /**
     * Transform the given array, retrieved from OpenWeatherMap API to CurrentWeather object
     * @param array $data
     * @return CurrentWeather
     */
    public static function transform(array $data): CurrentWeather
    {
        $weather = $data['weather'] ? $data['weather'][0] : [];
        $main = $data['main'] ?? [];
        $wind = $data['wind'] ?? [];
        $clouds= $data['clouds'] ?? [];

        $dto = new self();

        $dto->weather = $weather['main'] ?? '';
        $dto->description = $weather['description'] ?? '';
        $dto->icon = $weather['icon'] ?? '';

        $dto->temp = $main['temp'] ?? 0;
        $dto->humidity = $main['humidity'] ?? 0;
        $dto->pressure = $main['pressure'] ?? 0;

        $dto->windSpeed = $wind['speed'] ?? 0;
        $dto->windDirection = $wind['deg'] ? self::windDegToDirection($wind['deg']) : 'Северный';

        $dto->clouds = $clouds['all'] ?? 0;

        return $dto;
    }

    /**
     * Return wind direction by wind degrees
     * @param $deg
     * @return string
     */
    protected static function windDegToDirection($deg): string
    {
        $direction = 'Северный';
        if($deg > 0) {
            $direction = 'Восточный';
            if($deg >= 180) {
                $direction = 'Южный';
                if($deg >= 270) {
                    $direction = 'Западный';
                }
            }
        }

        return $direction;
    }
}
