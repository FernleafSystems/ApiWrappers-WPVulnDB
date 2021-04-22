<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

/**
 * Class BaseVulnResultsVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Common\VO
 * @property string   $asset_type        - plugin / theme / core
 * @property string   $latest_version
 * @property VulnVO[] $vulnerabilities
 */
class BaseVulnResultsVO extends \FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass {

	public function __get( string $key ) {
		$value = parent::__get( $key );

		switch ( $key ) {
			case 'vulnerabilities':
				$value = is_array( $value ) ? $this->buildVulns( $value ) : [];
				break;
			default:
				break;
		}

		return $value;
	}

	private function buildVulns( array $raw ) :array {
		return array_map( fn( $v ) => ( new VulnVO() )->applyFromArray( $v ), $raw );
	}
}