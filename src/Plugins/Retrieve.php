<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Plugins;

/**
 * Class Retrieve
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Plugins
 */
class Retrieve extends Base {

	/**
	 * @return PluginVulnVO[]
	 */
	public function retrieve() {
		$aVulns = [];

		if ( $this->req()->isLastRequestSuccess() ) {
			$aVulns = array_map(
				function ( $aD ) {
					return $this->getVO()->applyFromArray( $aD );
				},
				$this->getDecodedResponseBody()[ $this->getParam( 'slug' ) ]
			);
		}

		return $aVulns;
	}

	/**
	 * @param string $sSlug
	 * @return $this
	 */
	public function filterBySlug( $sSlug ) {
		return $this->setParam( 'slug', $sSlug );
	}

	/**
	 * @return string
	 */
	protected function getUrlEndpoint() {
		return sprintf( '%s/%s', static::ENDPOINT_KEY, $this->getParam( 'slug' ) );
	}
}