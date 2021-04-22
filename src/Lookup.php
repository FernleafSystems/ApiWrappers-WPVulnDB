<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb;

use FernleafSystems\ApiWrappers\Base\ConnectionConsumer;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	Connection,
	VO\CoreVulnResultsVO,
	VO\LookupVO,
	VO\PluginThemeVulnResultsVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\InvalidConnectionException;

class Lookup {

	use ConnectionConsumer;

	private LookupVO $lookup;

	public function __construct( LookupVO $lookup ) {
		$this->lookup = $lookup;
	}

	/**
	 * @return CoreVulnResultsVO|PluginThemeVulnResultsVO
	 * @throws InvalidConnectionException
	 */
	public function run() {
		$conn = $this->getConnection();
		if ( !$conn instanceof Connection ) {
			throw new InvalidConnectionException();
		}

		if ( $conn instanceof WPScan\Connection ) {
		}
		elseif ( $conn instanceof Patchstack\Connection ) {
		}
		else {
			throw new InvalidConnectionException( 'Not a known type of Connection' );
		}
	}
}
