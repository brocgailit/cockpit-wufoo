<?php

namespace Wufoo\Controller;

use \LimeExtra\Controller;
use Wufoo\Controller\ReviewsEndpoint;

class WufooApi extends Controller {
	private $wufoo;

	public function __construct($options) {
		parent::__construct($options);
        $this->wufoo = new WufooEndpoint(
			"https://".$this->app['config']['reviews-io']['subdomain'].".wufoo.com/api/v3/forms/",
			$this->app['config']['reviews-io']['api_key']
		);
	}

    public function index() {

		$res = $this->wufoo->query('product/reviews/all');

		return $this->wufoo->renderResponse($res, function($res) {
			return ['reviews' => $res];
		});
	}

	public function product($sku) {

		if (empty($sku)) {
			return ['error' => 'You must provide a product sku.'];
		}
		$res = $this->wufoo->query('product/review', [
			'sku' => $sku
		]);

		return $this->wufoo->renderResponse($res, function($res) {
			return ['reviews' => $res];
		});
	}

}

?>