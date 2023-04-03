<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb;

use FernleafSystems\ApiWrappers\Base\ConnectionConsumer;
use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	Connection,
	VO\BaseVulnResultsVO,
	VO\Constants,
	VO\CoreVulnResultsVO,
	VO\LookupVO,
	VO\PluginThemeVulnResultsVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\{
	AssetSlugMissingException,
	InvalidAssetTypeException,
	InvalidConnectionException
};

class Lookup {

	use ConnectionConsumer;

	private LookupVO $lookup;

	public function __construct( LookupVO $lookup ) {
		$this->lookup = $lookup;
	}

	/**
	 * @return CoreVulnResultsVO|PluginThemeVulnResultsVO
	 * @throws InvalidConnectionException
	 * @throws InvalidAssetTypeException
	 */
	public function run() :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {
		$this->verifyRequest();

		$conn = $this->getConnection();

		if ( $conn instanceof WPScan\Connection ) {
			$result = ( new WPScan\Lookup( $this->getLookup() ) )
				->setConnection( $conn )
				->run();
		}
		elseif ( $conn instanceof Patchstack\Connection ) {
			$result = ( new Patchstack\Lookup( $this->getLookup() ) )
				->setConnection( $conn )
				->run();
		}
		elseif ( $conn instanceof WPVDB\Connection ) {
			$result = ( new WPVDB\Lookup( $this->getLookup() ) )
				->setConnection( $conn )
				->run();
		}
		else {
			throw new InvalidConnectionException( sprintf( 'Connection type: %s', get_class( $conn ) ) );
		}

		return $result;
	}

	public function getLookup() :LookupVO {
		return $this->lookup;
	}

	/**
	 * @throws InvalidConnectionException
	 * @throws InvalidAssetTypeException
	 * @throws AssetSlugMissingException
	 */
	protected function verifyRequest() {
		$this->verifyConnection();
		$this->verifyLookup();
	}

	/**
	 * @throws InvalidConnectionException
	 */
	protected function verifyConnection() {
		if ( !$this->getConnection() instanceof Connection ) {
			throw new InvalidConnectionException();
		}
	}

	/**
	 * @throws InvalidAssetTypeException
	 */
	protected function verifyLookup() {
		$look = $this->getLookup();
		if ( !in_array( $look->asset_type, Constants::ASSET_TYPES ) ) {
			throw new InvalidAssetTypeException( sprintf( 'Invalid asset type: %s', $look->asset_type ) );
		}

		if ( in_array( $look->asset_type, [ Constants::ASSET_TYPE_PLUGIN, Constants::ASSET_TYPE_THEME ] )
			 && empty( $look->asset_slug ) ) {
			throw new AssetSlugMissingException( sprintf( 'Invalid asset type: %s', $look->asset_type ) );
		}
	}
}
