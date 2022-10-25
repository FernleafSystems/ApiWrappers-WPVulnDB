<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\LookupVO;
use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api;

class PluginThemeRetrieve extends Api {

	const ENDPOINT_KEY = '';

	public function retrieve() :?PluginThemeVulnVO {

		if ( $this->hasLookupVO() ) {
			$lookup = $this->getLookupVO();
		}
		else {
			$lookup = new LookupVO();
			$lookup->asset_type = rtrim( static::ENDPOINT_KEY, 's' );
			$lookup->asset_slug = $this->filter_slug;
			$lookup->asset_version = $this->filter_version;
			$this->setLookupVO( $lookup );
		}

		$VO = null;

		if ( $this->req()->isLastRequestSuccess() ) {
			$response = $this->getDecodedResponseBody();
			if ( !empty( $response[ $lookup->asset_slug ] ) ) {
				$VO = $this->getVO()->applyFromArray( $response[ $lookup->asset_slug ] );
			}
		}

		if ( $VO instanceof PluginThemeVulnVO ) {

			$VO->asset_slug = $lookup->asset_slug;
			$VO->asset_type = $lookup->asset_type;

			if ( !empty( $lookup->asset_version ) ) {

				$VO->vulnerabilities = array_map(
					fn( $vul ) => $vul->getRawData(),
					array_filter(
						$VO->getVulns(),
						function ( $vuln ) use ( $lookup ) {
							return empty( $vuln->fixed_in )
								   || version_compare( $lookup->asset_version, $vuln->fixed_in, '<' );
						}
					)
				);
			}
		}

		return $VO;
	}

	protected function getVO() :PluginThemeVulnVO {
		return new PluginThemeVulnVO();
	}

	protected function getUrlEndpoint() :string {
		return sprintf( '%s/%s', static::ENDPOINT_KEY, $this->getLookupVO()->asset_slug );
	}
}