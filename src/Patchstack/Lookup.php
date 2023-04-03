<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\{
	CoreVulnResultsVO,
	PluginThemeVulnResultsVO
};

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	public function run() :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {
		return ( new Retrieve() )
			->setConnection( $this->getConnection() )
			->setLookupVO( $this->getLookup() )
			->retrieve();
	}
}
