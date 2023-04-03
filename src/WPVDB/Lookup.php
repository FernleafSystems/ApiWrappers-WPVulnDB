<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPVDB;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\Consumer\LookupConsumer;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\CoreVulnResultsVO;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\PluginThemeVulnResultsVO;

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	use LookupConsumer;

	public function run() :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {
		return ( new Retrieve() )
			->setConnection( $this->getConnection() )
			->setLookupVO( $this->getLookup() )
			->retrieve();
	}
}