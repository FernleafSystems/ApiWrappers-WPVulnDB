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
			$lookup->asset_version = $this->filter_version;
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

	protected function getVO() :CoreVulnVO {
		return new CoreVulnVO();
	}

	protected function getUrlEndpoint() :string {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), str_replace( '.', '', $this->getLookupVO()->asset_version ) );
	}
}