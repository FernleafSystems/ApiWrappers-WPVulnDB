<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	VO\BaseVulnResultsVO,
	VO\Constants,
	VO\CoreVulnResultsVO,
	VO\PluginThemeVulnResultsVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\InvalidConnectionException;
use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\{
	Core
};

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	/**
	 * @return CoreVulnResultsVO|PluginThemeVulnResultsVO
	 * @throws InvalidConnectionException
	 */
	public function run() :BaseVulnResultsVO {
		$look = $this->getLookup();
		switch ( $look->asset_type ) {

			case Constants::ASSET_TYPE_WP:
				$retriever = new Core\Retrieve();
				break;

			case Constants::ASSET_TYPE_PLUGIN:
				$retriever = new Plugins\Retrieve();
				break;

			case Constants::ASSET_TYPE_THEME:
				$retriever = new Themes\Retrieve();
				break;
		}

		$result = $retriever->setConnection( $this->getConnection() )->retrieve();
	}
}