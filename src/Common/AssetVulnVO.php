<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common;

/**
 * Class AssetVulnVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Plugins
 * @property string  $latest_version
 * @property string  $last_updated      - e.g 2015-09-10T09:16:00.000Z
 * @property bool    $popular
 * @property array[] $vulnerabilities
 */
class AssetVulnVO extends \FernleafSystems\ApiWrappers\Base\BaseVO {

	/**
	 * @return int
	 */
	public function getLastUpdatedAt() {
		return strtotime( $this->last_updated );
	}

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