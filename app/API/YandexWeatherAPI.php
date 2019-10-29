<?php
/**
 * Created by PhpStorm.
 * User: lutov
 * Date: 29.10.2019
 * Time: 17:29
 */

namespace App\API;

use GuzzleHttp\Client;

class YandexWeatherAPI {

	private $endpoint = 'https://api.weather.yandex.ru/v1/';

	private $client;

	/**
	 * YandexWeatherAPI constructor.
	 * @param string $key
	 */
	public function __construct(string $key) {

		$headers = [
			'X-Yandex-API-Key' => $key,
		];

		$this->client = new Client([
			'base_uri' => $this->endpoint,
			'headers' => $headers,
			'timeout'  => 2.0,
		]);

	}

	/**
	 * @param float $lat
	 * @param float $lon
	 * @return mixed
	 */
	public function getTemperature(float $lat, float $lon) {

		$url = 'forecast';

		$data = array(
			"query" => array(
				'lat' => $lat,
				'lon' => $lon,
				'lang' => 'ru_RU'
			),
		);

		$result = json_decode($this->client->get($url, $data)->getBody());

		return $result->fact->temp;

	}

}