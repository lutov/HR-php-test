<?php

namespace App\Http\Controllers;

use App\API\YandexWeatherAPI;
use Illuminate\Http\Request;

class StaticController extends Controller {

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function temperature() {

		$key = env('YANDEX_WEATHER_API_KEY');

		$yandex_weather_api = new YandexWeatherAPI($key);

		$lat = 53.259003;
		$lon = 34.442746;

		$temperature = $yandex_weather_api->getTemperature($lat, $lon);

		return view('home.temperature', array(
			'temperature' => $temperature,
		));

	}

}
