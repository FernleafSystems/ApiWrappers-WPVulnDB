<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	VO\BaseVulnResultsVO,
	VO\CoreVulnResultsVO,
	VO\PluginThemeVulnResultsVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\InvalidConnectionException;

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	/**
	 * @return CoreVulnResultsVO|PluginThemeVulnResultsVO
	 * @throws InvalidConnectionException
	 */
	public function run() :BaseVulnResultsVO {
	}
}
