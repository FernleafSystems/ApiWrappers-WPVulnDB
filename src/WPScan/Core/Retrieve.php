<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

/**
 * Class Retrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core
 */
class Retrieve extends Base {

	/**
	 * @return CoreVulnVO|null - retrieve null will mean that that no vulnerabilities were found for that version
	 */
	public function retrieve() {
		return $this->req()->isLastRequestSuccess() ?
			$this->getVO()->applyFromArray( $this->getDecodedResponseBody()[ $this->getParam( 'filter_version' ) ] )
			: null;
	}

	/**
	 * @return CoreVulnVO
	 */
	protected function getVO() {
		return new CoreVulnVO();
	}

	/**
	 * @param string $sSlug
	 * @return $this
	 */
	public function filterByVersion( $sSlug ) {
		return $this->setParam( 'filter_version', $sSlug );
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', parent::getUrlEndpoint(), str_replace( '.', '', $this->getParam( 'filter_version' ) ) );
	}
}