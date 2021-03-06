<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

/**
 * Class Base
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core
 */
class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api {

	const ENDPOINT_KEY = 'wordpresses';

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return static::ENDPOINT_KEY;
	}
}