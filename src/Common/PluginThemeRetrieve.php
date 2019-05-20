<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common;

use FernleafSystems\ApiWrappers\Base\BaseVO;
use FernleafSystems\ApiWrappers\WpVulnDb\Api;

/**
 * Class PluginThemeRetrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Common
 */
class PluginThemeRetrieve extends Api {

	const ENDPOINT_KEY = '';

	/**
	 * @return BaseVO|null
	 */
	public function retrieve() {
		$oVo = null;

		$this->req();
		if ( $this->isLastRequestSuccess() ) {
			$oVo = $this->getVO();
			$oVo->applyFromArray( $this->getDecodedResponseBody()[ $this->getParam( 'filter_slug' ) ] );
		}

		$sFilterVersion = $this->getParam( 'filter_version' );
		if ( !empty( $oVo ) && !empty( $sFilterVersion ) ) {

			$oVo->vulnerabilities = array_map(
				function ( $oVuln ) {
					/** @var VulnVO $oVuln */
					return $oVuln->getRawDataAsArray();
				},
				array_filter(
					$oVo->getVulns(),
					function ( $oVuln ) use ( $sFilterVersion ) {
						/** @var VulnVO $oVuln */
						return empty( $oVuln->fixed_in ) || version_compare( $sFilterVersion, $oVuln->fixed_in, '<' );
					}
				)
			);
		}

		return $oVo;
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