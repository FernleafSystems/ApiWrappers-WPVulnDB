<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * Class VulnVO
 * @package FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Plugins
 * @property int    $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property string $published_date
 * @property array  $references
 * @property string $vuln_type
 * @property string $fixed_in
 */
class VulnVO extends DynPropertiesClass {

	public function isValid() :bool {
		return count( $this->getRawData() ) > 0;
	}
}