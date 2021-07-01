<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\Consumer;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\LookupVO;

trait LookupConsumer {

	private ?LookupVO $lookupVO = null;

	public function getLookupVO() :LookupVO {
		return $this->lookupVO;
	}

	public function hasLookupVO() :bool {
		return !empty( $this->lookupVO );
	}

	public function setLookupVO( LookupVO $lookup ) :self {
		$this->lookupVO = $lookup;
		return $this;
	}
}