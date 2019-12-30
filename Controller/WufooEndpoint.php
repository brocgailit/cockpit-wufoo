<?php

namespace ReviewsIO\Controller;

use GuzzleHttp\Client;

class ReviewsEndpoint {
	public $api_key;
	private $client;

	public function __construct($base_uri, $api_key) {
		$this->api_key = $api_key;
		$this->store = $store;
		$this->client = new Client([
			'base_uri' => $base_uri
		]);
	}

	public function query($endpoint = '', $options = []) {
		$res = $this->client->request('GET', $endpoint, [
			'auth' => [$this->api_key, 'heavycraft'],
			'query' => $options
		]);
		return json_decode($res->getBody());
	}

	public function renderResponse($res, $return_fn) {

		/* $status = $res->requestStatus;

		if ( !$status->success ) {
			return $status;		
		} */

		return $return_fn($res);
	}

}

?>