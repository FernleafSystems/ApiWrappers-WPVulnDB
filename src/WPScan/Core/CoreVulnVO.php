<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

use FernleafSystems\ApiWrappers\Base\BaseVO;
use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common\VulnVO;

/**
 * @property string  $changelog_url
 * @property string  $status
 * @property string  $release_date
 * @property array[] $vulnerabilities
 */
class CoreVulnVO extends BaseVO {

	public function isValid() :bool {
		return count( $this->getRawData() ) > 0;
	}

	/**
	 * @return VulnVO[]
	 */
	public function getVulns() :array {
		return array_map(
			function ( $v ) {
				return ( new VulnVO() )->applyFromArray( $v );
			},
			is_array( $this->vulnerabilities ) ? $this->vulnerabilities : []
		);
	}
}