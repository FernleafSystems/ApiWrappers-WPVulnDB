<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

use FernleafSystems\ApiWrappers\Base\BaseApi;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\Consumer\LookupConsumer;

class Api extends BaseApi {

	use LookupConsumer;

	const REQUEST_METHOD = 'get';

	protected function preFlight() {
		$this->setRequestHeader( 'PSKey', $this->getConnection()->api_key );
	}

	protected function extractVulnerabilitiesFromResponse() :array {
		return $this->getDecodedResponseBody()[ 'vulnerabilities' ];
	}
}