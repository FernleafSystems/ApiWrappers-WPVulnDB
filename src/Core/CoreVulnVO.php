<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Core;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VulnVO;

/**
 * Class CoreVulnVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Core
 * @property string  $changelog_url
 * @property string  $status
 * @property string  $release_date
 * @property array[] $vulnerabilities
 */
class CoreVulnVO extends \FernleafSystems\ApiWrappers\Base\BaseVO {

	/**
	 * @return VulnVO[]
	 */
	public function getVulns() {
		return array_map(
			function ( $aV ) {
				return ( new VulnVO() )->applyFromArray( $aV );
			},
			$this->vulnerabilities
		);
	}
}