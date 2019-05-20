<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Plugins;

/**
 * Class Base
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Plugins
 */
class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\Api {

	const ENDPOINT_KEY = 'plugins';

	/**
	 * @return PluginVulnVO
	 */
	protected function getVO() {
		return new PluginVulnVO();
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return static::ENDPOINT_KEY;
	}
}