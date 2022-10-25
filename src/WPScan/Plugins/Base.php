<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Plugins;

/**
 * Class Base
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Plugins
 */
class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api {

	const ENDPOINT_KEY = 'plugins';

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() :string{
		return static::ENDPOINT_KEY;
	}
}