<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * Class LookupVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Common
 * @property string $asset_type
 * @property string $asset_slug
 * @property string $asset_version
 * @property string $provider
 */
class LookupVO extends DynPropertiesClass {

	public function __get( string $key ) {

		switch ( $key ) {
			case 'asset_slug':
				if ( $this->asset_type === Constants::ASSET_TYPE_WP ) {
					$value = 'wordpress';
				}
				break;
			default:
				$value = parent::__get( $key );
				break;
		}

		return $value;
	}
}