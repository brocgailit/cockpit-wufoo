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
		return $this->wufoo->query("");
	}

	public function forms($identifier) {
		if (empty($identifier)) {
			return $this->wufoo->query("forms.json", []);
		}
		if($this->req_is('post')) {
			$data = json_decode(file_get_contents('php://input'), true);
			return $this->wufoo->post('', $data);
		}
		return $this->wufoo->query("forms/$identifier.json", []);
	}

	public function fields($identifier) {
		return $this->wufoo->query("forms/$identifier/fields.json", []);
	}

}

?>