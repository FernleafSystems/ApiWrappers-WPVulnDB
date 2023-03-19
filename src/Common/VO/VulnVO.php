<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * @property string|int $id
 * @property string     $title
 * @property string     $description
 * @property string     $vuln_type
 * @property string     $fixed_in
 * @property string     $affected_in
 * @property array[]    $patched_in_ranges
 * @property array      $references
 * @property int        $published_at
 * @property int        $disclosed_at
 * @property int        $created_at
 * @property int        $updated_at
 */
class VulnVO extends DynPropertiesClass {

	public function __get( string $key ) {
		$value = parent::__get( $key );

		if ( \str_ends_with( $key, '_at' ) ) {
			$value = (int)$value;
		}

		switch ( $key ) {
			case 'references':
				if ( !is_array( $value ) ) {
					$value = [];
				}
				break;
			default:
				break;
		}

		return $value;
	}
}