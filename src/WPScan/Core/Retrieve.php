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
			$lookup->asset_slug = Constants::ASSET_TYPE_WP;
			$lookup->asset_version = $this->getParam( 'filter_version' );
			$this->setLookupVO( $lookup );
		}

		return $this->req()->isLastRequestSuccess() ?
			$this->getVO()->applyFromArray( $this->getDecodedResponseBody()[ $lookup->asset_version ] )
			: null;
	}

	/**
	 * @return CoreVulnVO
	 */
	protected function getVO() {
		return new CoreVulnVO();
	}

	/**
	 * @param string $version
	 * @return $this
	 * @deprecated 2.0 - use lookupVO
	 */
	public function filterByVersion( string $version ) {
		return $this->setParam( 'filter_version', $version );
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), str_replace( '.', '', $this->getLookupVO()->asset_version ) );
	}
}