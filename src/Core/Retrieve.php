<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Core;

/**
 * Class Retrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Core
 */
class Retrieve extends \FernleafSystems\ApiWrappers\WpVulnDb\Api {

	const ENDPOINT_KEY = 'wordpresses';

	/**
	 * @return CoreVulnVO|null - retrieve null will mean that that no vulnerabilities were found for that version
	 */
	public function retrieve() {
		return $this->req()->isLastRequestSuccess() ?
			$this->getVO()->applyFromArray( $this->getDecodedResponseBody()[ $this->getParam( 'filter_version' ) ] )
			: null;
	}

	/**
	 * @param string $sSlug
	 * @return $this
	 */
	public function filterByVersion( $sSlug ) {
		return $this->setParam( 'filter_version', $sSlug );
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
		return sprintf( '%s/%s', static::ENDPOINT_KEY, str_replace( '.', '', $this->getParam( 'filter_version' ) ) );
	}
}