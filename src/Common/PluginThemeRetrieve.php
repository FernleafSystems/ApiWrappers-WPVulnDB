<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common;

use FernleafSystems\ApiWrappers\WpVulnDb\Api;

/**
 * Class PluginThemeRetrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Common
 */
class PluginThemeRetrieve extends Api {

	const ENDPOINT_KEY = '';

	/**
	 * @return PluginThemeVulnVO|null
	 */
	public function retrieve() {
		$oVO = null;

		$this->req();
		if ( $this->isLastRequestSuccess() ) {
			$aResp = $this->getDecodedResponseBody();
			if ( !empty( $aResp[ $this->getParam( 'filter_slug' ) ] ) ) {
				$oVO = $this->getVO();
				$oVO->applyFromArray( $aResp[ $this->getParam( 'filter_slug' ) ] );
			}
		}

		if ( $oVO instanceof PluginThemeVulnVO ) {

			$oVO->asset_type = rtrim( static::ENDPOINT_KEY, 's' );

			$sFilterVersion = $this->getParam( 'filter_version' );
			if ( !empty( $sFilterVersion ) ) {

				$oVO->vulnerabilities = array_map(
					function ( $vuln ) {
						return $vuln->getRawDataAsArray();
					},
					array_filter(
						$oVO->getVulns(),
						function ( $vuln ) use ( $sFilterVersion ) {
							return empty( $vuln->fixed_in ) || version_compare( $sFilterVersion, $vuln->fixed_in, '<' );
						}
					)
				);
			}
		}

		return $oVO;
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