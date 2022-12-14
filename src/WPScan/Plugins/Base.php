<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Plugins;

class Base extends \FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api {

	const ENDPOINT_KEY = 'plugins';

	protected function getUrlEndpoint() :string {
		return static::ENDPOINT_KEY;
	}
}