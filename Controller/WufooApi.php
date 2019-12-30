<?php

namespace Wufoo\Controller;

use \LimeExtra\Controller;
use Wufoo\Controller\WufooEndpoint;

class WufooApi extends Controller {
	private $wufoo;

	public function __construct($options) {
		parent::__construct($options);
        $this->wufoo = new WufooEndpoint(
			"https://".$this->app['config']['wufoo']['subdomain'].".wufoo.com/api/v3/",
			$this->app['config']['wufoo']['api_key']
		);
	}

    public function index() {

		$res = $this->wufoo->query("");

		return $this->wufoo->renderResponse($res, function($res) {
			return ['forms' => $res];
		});
	}

	public function forms($identifier) {

		if (empty($identifier)) {
			
			$res = $this->wufoo->query("forms.json", []);

			return $this->wufoo->renderResponse($res, function($res) {
				return ['forms' => $res];
			});
		}
		$res = $this->wufoo->query("forms/$identifier.json", []);

		return $this->wufoo->renderResponse($res, function($res) {
			return ['form' => $res];
		});
	}

}

?>