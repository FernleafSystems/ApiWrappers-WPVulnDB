<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

/**
 * Class CoreVulnVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\CoreVulnVO\Core
 * @property string  $changelog_url
 * @property string  $status
 * @property string  $release_date
 * @property array[] $vulnerabilities
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