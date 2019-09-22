<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Core;

/**
 * Class Base
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Core
 */
class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\Api {

	const ENDPOINT_KEY = 'wordpresses';

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return static::ENDPOINT_KEY;
	}
}