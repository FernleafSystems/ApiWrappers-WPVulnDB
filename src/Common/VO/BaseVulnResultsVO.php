<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

use FernleafSystems\ApiWrappers\Base\BaseVO;

/**
 * @property string   $asset_type        - plugin / theme / core
 * @property string   $latest_version
 * @property VulnVO[] $vulnerabilities   - should be stored as raw array for conversion on-demand
 * @property string   $provider          - one of wpscan, patchstack
 * @property LookupVO $lookup
 */
class BaseVulnResultsVO extends BaseVO {

	public function __get( string $key ) {
		$value = parent::__get( $key );

		switch ( $key ) {
			case 'vulnerabilities':
				$value = array_filter( array_map( function ( $v ) {
					return is_array( $v ) ? ( new VulnVO() )->applyFromArray( $v ) : null;
				}, is_array( $value ) ? $value : [] ) );
				break;
			default:
				break;
		}

		return $value;
	}

	public function __set( string $key, $value ) {
		switch ( $key ) {
			case 'vulnerabilities':
				$value = array_filter( array_map( function ( $v ) {
					/** @var VulnVO $v */
					return $v instanceof VulnVO ? $v->getRawData() : null;
				}, is_array( $value ) ? $value : [] ) );
				break;
			default:
				break;
		}
		parent::__set( $key, $value );
	}
}