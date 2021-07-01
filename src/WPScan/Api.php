<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

use FernleafSystems\ApiWrappers\Base\BaseApi;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\Consumer\LookupConsumer;

class Api extends BaseApi {

	use LookupConsumer;
	const REQUEST_METHOD = 'get';

	protected function preFlight() {
		$this->setRequestHeader( 'Authorization', sprintf( 'Token token=%s', $this->getConnection()->api_key ) );
	}
}