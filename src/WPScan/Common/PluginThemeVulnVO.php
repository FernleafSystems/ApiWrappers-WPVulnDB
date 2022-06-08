<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * @property string  $latest_version
 * @property string  $asset_slug
 * @property string  $asset_type        - plugin / theme
 * @property string  $last_updated      - e.g 2015-09-10T09:16:00.000Z
 * @property bool    $popular
 * @property array[] $vulnerabilities
 */
class PluginThemeVulnVO extends DynPropertiesClass {

	public function isValid() :bool {
		return count( $this->getRawData() ) > 0;
	}

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
			function ( $v ) {
				return ( new VulnVO() )->applyFromArray( $v );
			},
			is_array( $this->vulnerabilities ) ? $this->vulnerabilities : []
		);
	}
}