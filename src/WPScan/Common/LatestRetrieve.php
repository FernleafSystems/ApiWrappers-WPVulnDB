<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

/**
 * Trait LatestRetrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Plugins
 */
trait LatestRetrieve {

	/**
	 * @return WpVulnDb\Common\VulnVO[]
	 */
	public function retrieve() {
		$aVulns = [];
		$aData = $this->req()->isLastRequestSuccess() ? $this->getDecodedResponseBody() : null;
		if ( is_array( $aData ) ) {
			$aVulns = array_map(
				function ( $aVuln ) {
					return $this->getVO()->applyFromArray( $aVuln );
				},
				$aData
			);
		}
		return $aVulns;
	}

	/**
	 * @return WpVulnDb\Common\VulnVO
	 */
	protected function getVO() {
		return new WpVulnDb\Common\VulnVO();
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), 'latest' );
	}
}