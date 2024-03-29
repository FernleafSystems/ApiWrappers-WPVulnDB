<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Themes;

class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api {

	const ENDPOINT_KEY = 'themes';

	protected function getUrlEndpoint() :string {
		return static::ENDPOINT_KEY;
	}
}