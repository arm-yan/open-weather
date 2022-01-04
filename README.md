<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Weather API
## Serving Project 
`php artisan serve`

By default the HTTP-server will listen to port 8000. However if that port is already in use or you wish to serve multiple applications this way, you might want to specify what port to use. Just add the --port argument:

`php artisan serve --port=8080`

## Request Example

`GET http://127.0.0.1:8000/api/weather/current?city=moscow&unit=celsius`

## Response Example

```json{
"code": 200,
"error": false,
"data": {
    "temp": -7.07,
    "weather": "Clouds",
    "description": "пасмурно",
    "icon": "04n",
    "humidity": 97,
    "windSpeed": 2.1,
    "windDirection": "Восточный",
    "pressure": 1006,
    "clouds": 96
}
```

## Available Units: Celsius, Fahrenheit
## Default Language: Russian
