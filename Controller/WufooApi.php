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

	public function forms($identifier) {

		if (empty($identifier)) {
			return ['error' => 'You must provide a form identifier.'];
		}
		$res = $this->wufoo->query($identifier.".json", []);

		return $this->wufoo->renderResponse($res, function($res) {
			return ['form' => $res];
		});
	}

}

?>