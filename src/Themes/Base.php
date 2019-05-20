<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Themes;

/**
 * Class Base
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Themes
 */
class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\Api {

	const ENDPOINT_KEY = 'themes';

	/**
	 * @return ThemeVulnVO
	 */
	protected function getVO() {
		return new ThemeVulnVO();
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return static::ENDPOINT_KEY;
	}
}