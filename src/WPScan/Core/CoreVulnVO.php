<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common\VulnVO;
use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * @property string  $changelog_url
 * @property string  $status
 * @property string  $release_date
 * @property array[] $vulnerabilities
 */
class CoreVulnVO extends DynPropertiesClass {

	public function isValid() :bool {
		return count( $this->getRawData() ) > 0;
	}

	/**
	 * @return VulnVO[]
	 */
	public function getVulns() {
		return array_map(
			function ( $v ) {
				return ( new VulnVO() )->applyFromArray( $v );
			},
			is_array( $this->vulnerabilities ) ? $this->vulnerabilities : []
		);
	}
}