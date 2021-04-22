<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb;

use FernleafSystems\ApiWrappers\Base\BaseApi;

/**
 * Class Api
 * @package FernleafSystems\ApiWrappers\WpVulnDb
 * @deprecated 2.0
 */
class Api extends BaseApi {

	const REQUEST_METHOD = 'get';

	protected function preFlight() {
		$this->setRequestHeader( 'Authorization', sprintf( 'Token token=%s', $this->getConnection()->api_key ) );
	}
}