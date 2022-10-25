<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

trait LatestRetrieve {

	/**
	 * @return WPScan\Common\VulnVO[]
	 */
	public function retrieve() :array {
		return array_map(
			function ( $v ) {
				return $this->getVO()->applyFromArray( $v );
			},
			$this->req()->isLastRequestSuccess() ? $this->getDecodedResponseBody() : []
		);
	}

	protected function getVO() :WPScan\Common\VulnVO {
		return new WPScan\Common\VulnVO();
	}

	protected function getUrlEndpoint() :string {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), 'latest' );
	}
}