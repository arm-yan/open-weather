<?php
declare(strict_types=1);

namespace App\Services\WeatherService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 *  WeatherService, working with OpenWeatherMap API
 * @see https://openweathermap.org/api
 */
class OpenWeatherMap implements WeatherService
{
    /**
     * HttpClient, for HTTP requests
     * @var Client
     */
    protected Client $httpClient;

    /**
     * OpenWeatherMap API KEY
     * @see https://home.openweathermap.org/api_keys
     * @var string|mixed
     */
    protected string $appID;

    /**
     * OpenWeatherMap API URI
     * @var string|mixed
     */
    protected string $apiEndPoint;

    /**
     * OpenWeatherMap API Language
     * @see https://openweathermap.org/current#multi
     * @var string|mixed
     */
    protected string $language;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
        $this->appID = env('OPEN_WEATHER_MAP_APPID', null);
        $this->apiEndPoint = env('OPEN_WEATHER_MAP_API', null);
        $this->language = env('API_LANG', 'ru');
    }

    /**
     * Make a call to OpenWeatherMap API, for given city, by unit type and language
     * @param string $city
     * @param string $unit
     * @return array
     */
    public function request(string $city, string $unit): array
    {
        $unit = $unit == 'celsius' ? 'metric' : 'imperial';

        try {
            $resource = $this->httpClient->request('GET', $this->apiEndPoint, [
                'query' => [
                    'q'     => $city,
                    'appid' => $this->appID,
                    'units' => $unit,
                    'lang'  => $this->language,
                ]
            ]);

            $response = $resource->getBody()->getContents();
            $data = json_decode($response, true);

            return $this->responseSuccess($data);
        } catch (GuzzleException $exception) {
            return $this->throwException($exception);
        }
    }

    /**
     * @param array $data
     * @return array
     */
    protected function responseSuccess(array $data): array
    {
        return [
            'code' => 200,
            'error' => false,
            'data' => $data
        ];
    }

    /**
     * @param Throwable $exception
     * @return array
     */
    protected function throwException(Throwable $exception): array
    {
        return [
            'code' => $exception->getCode(),
            'error' => true,
            'message' => $exception->getMessage()
        ];
    }
}
