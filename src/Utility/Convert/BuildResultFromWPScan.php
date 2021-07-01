<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\Utility\Convert;

use FernleafSystems\ApiWrappers\WpVulnDb\Common;

class BuildResultFromWPScan {

	private $raw = null;

	/**
	 * @param mixed $rawResponse
	 * @return mixed
	 */
	public function build( $rawResponse ) {
		$this->raw = $rawResponse;
	}

	public function buildForCore( $result ) :Common\VO\CoreVulnResultsVO {

	}

	public function buildForPluginTheme( $result ) :Common\VO\PluginThemeVulnResultsVO {

	}
}