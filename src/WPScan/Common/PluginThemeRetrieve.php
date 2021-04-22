<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Api;

/**
 * Class PluginThemeRetrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common
 */
class PluginThemeRetrieve extends Api {

	const ENDPOINT_KEY = '';

	/**
	 * @return PluginThemeVulnVO|null
	 */
	public function retrieve() {
		$VO = null;

		$this->req();
		if ( $this->isLastRequestSuccess() ) {
			$aResp = $this->getDecodedResponseBody();
			if ( !empty( $aResp[ $this->getParam( 'filter_slug' ) ] ) ) {
				$VO = $this->getVO();
				$VO->applyFromArray( $aResp[ $this->getParam( 'filter_slug' ) ] );
			}
		}

		if ( $VO instanceof PluginThemeVulnVO ) {

			$VO->asset_slug = $this->getParam( 'filter_slug' );
			$VO->asset_type = rtrim( static::ENDPOINT_KEY, 's' );

			$sFilterVersion = $this->getParam( 'filter_version' );
			if ( !empty( $sFilterVersion ) ) {

				$VO->vulnerabilities = array_map(
					function ( $vuln ) {
						return $vuln->getRawData();
					},
					array_filter(
						$VO->getVulns(),
						function ( $vuln ) use ( $sFilterVersion ) {
							return empty( $vuln->fixed_in ) || version_compare( $sFilterVersion, $vuln->fixed_in, '<' );
						}
					)
				);
			}
		}

		return $VO;
	}

	/**
	 * @param string $sVersion
	 * @return $this
	 */
	public function filterByVersion( $sVersion ) {
		return $this->setParam( 'filter_version', ltrim( trim( $sVersion ), 'v' ) );
	}

	/**
	 * @param string $sSlug
	 * @return $this
	 */
	public function filterBySlug( $sSlug ) {
		return $this->setParam( 'filter_slug', $sSlug );
	}

	/**
	 * @return PluginThemeVulnVO
	 */
	protected function getVO() {
		return new PluginThemeVulnVO();
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', static::ENDPOINT_KEY, $this->getParam( 'filter_slug' ) );
	}
}