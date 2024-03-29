<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * @property string $asset_type
 * @property string $asset_slug
 * @property string $asset_version
 * @property string $provider
 */
class LookupVO extends DynPropertiesClass {

	public function __get( string $key ) {

		$value = parent::__get( $key );

		switch ( $key ) {

			case 'asset_slug':
				if ( $this->asset_type === Constants::ASSET_TYPE_WP ) {
					$value = 'wordpress';
				}
				break;

			case 'asset_version':
				if ( empty( $value ) ) {
					$value = '0.0.0'; // ALL
				}
				break;

			default:
				break;
		}

		return $value;
	}
}