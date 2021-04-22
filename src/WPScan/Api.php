<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

use FernleafSystems\ApiWrappers\Base\BaseApi;

class Api extends BaseApi {

	const REQUEST_METHOD = 'get';

	protected function preFlight() {
		$this->setRequestHeader( 'Authorization', sprintf( 'Token token=%s', $this->getConnection()->api_key ) );
	}
}