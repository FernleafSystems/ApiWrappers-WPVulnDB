<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Plugins;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\PluginThemeRetrieve;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\PluginThemeVulnVO;

/**
 * Class Retrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Plugins
 */
class Retrieve extends PluginThemeRetrieve {

	const ENDPOINT_KEY = 'plugins';

	/**
	 * @inheritDoc
	 */
	public function retrieve() {
		$oVO = parent::retrieve();
		if ( $oVO instanceof PluginThemeVulnVO ) {
			$oVO->asset_type = 'plugin';
		}
		return $oVO;
	}
}