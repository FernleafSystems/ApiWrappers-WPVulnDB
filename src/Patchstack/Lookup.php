<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\BaseVulnResultsVO;

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	/**
	 * @inheritDoc
	 */
	public function run() :BaseVulnResultsVO {
		return ( new Retrieve() )
			->setConnection( $this->getConnection() )
			->setLookupVO( $this->getLookup() )
			->retrieve();
	}
}
