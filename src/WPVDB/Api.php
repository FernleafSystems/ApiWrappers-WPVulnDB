<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPVDB;

use FernleafSystems\ApiWrappers\Base\BaseApi;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\Consumer\LookupConsumer;

class Api extends BaseApi {

	use LookupConsumer;

	const REQUEST_METHOD = 'get';

	protected function extractVulnerabilitiesFromResponse() :array {
		return $this->getDecodedResponseBody()[ 'data' ][ 'vulnerability' ];
	}
}