<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Common;

use FernleafSystems\ApiWrappers\Base\BaseVO;
use FernleafSystems\Utilities\Data\Adapter\DynPropertiesClass;

/**
 * @property int    $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property string $published_date
 * @property array  $references
 * @property string $vuln_type
 * @property string $fixed_in
 */
class VulnVO extends BaseVO {

	public function isValid() :bool {
		return count( $this->getRawData() ) > 0;
	}
}