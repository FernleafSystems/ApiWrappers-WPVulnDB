<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\Constants;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\LookupVO;

class Retrieve extends Base {

	public function retrieve() :?CoreVulnVO {

		if ( $this->hasLookupVO() ) {
			$lookup = $this->getLookupVO();
		}
		else {
			$lookup = new LookupVO();
			$lookup->asset_type = Constants::ASSET_TYPE_WP;
			$lookup->asset_version = $this->getParam( 'filter_version' );
			$this->setLookupVO( $lookup );
		}

		$vul = null;
		if ( $this->req()->isLastRequestSuccess() ) {
			$decoded = $this->getDecodedResponseBody();
			if ( !empty( $decoded[ $lookup->asset_version ] ) ) {
				$vul = $this->getVO()->applyFromArray( $decoded[ $lookup->asset_version ] );
			}
		}
		return $vul;
	}

	/**
	 * @return CoreVulnVO
	 */
	protected function getVO() {
		return new CoreVulnVO();
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), str_replace( '.', '', $this->getLookupVO()->asset_version ) );
	}

	/**
	 * @param string $version
	 * @return $this
	 * @deprecated 2.0 - use lookupVO
	 */
	public function filterByVersion( string $version ) {
		return $this->setParam( 'filter_version', $version );
	}
}