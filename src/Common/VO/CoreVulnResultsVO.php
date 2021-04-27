<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

/**
 * Class CoreVulnResultsVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\Common\VO
 * @property string $changelog_url
 * @property string $status
 * @property int    $released_at
 */
class CoreVulnResultsVO extends BaseVulnResultsVO {

	public function __get( string $key ) {

		switch ( $key ) {
			case 'asset_type':
				$value = 'wordpress';
				break;
			default:
				$value = parent::__get( $key );
				break;
		}

		return $value;
	}
}