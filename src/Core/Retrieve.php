<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Core;

/**
 * Class Retrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Core
 */
class Retrieve extends Base {

	/**
	 * @return CoreVulnVO[]
	 */
	public function retrieve() {
		$aVulns = [];

		if ( $this->req()->isLastRequestSuccess() ) {
			$aVulns = array_map(
				function ( $aD ) {
					return $this->getVO()->applyFromArray( $aD );
				},
				$this->getDecodedResponseBody()[ $this->getParam( 'version' ) ]
			);
		}

		return $aVulns;
	}

	/**
	 * @param string $sSlug
	 * @return $this
	 */
	public function filterByVersion( $sSlug ) {
		return $this->setParam( 'version', $sSlug );
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', static::ENDPOINT_KEY, str_replace( '.', '', $this->getParam( 'version' ) ) );
	}
}