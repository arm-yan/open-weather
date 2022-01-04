<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\CurrentWeather;
use App\DTO\OpenWeatherCWDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetCurrentWeatherRequest;
use App\Services\WeatherService\WeatherService;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    protected WeatherService $service;

    protected CurrentWeather $currentWeatherDto;

    public function __construct(OpenWeatherCWDTO $currentWeatherDto)
    {
        $this->service = app('weather-service');
        $this->currentWeatherDto = $currentWeatherDto;
    }

    /**
     * @param GetCurrentWeatherRequest $request
     * @return JsonResponse
     */
    public function getCurrentWeatherData(GetCurrentWeatherRequest $request): JsonResponse
    {
        $result = $this->service->request($request->get('city'), $request->get('unit'));

        if(array_key_exists('data', $result)) {
            $result['data'] = $this->currentWeatherDto::transform($result['data']);
        }

        return response()->json($result);
    }
}
