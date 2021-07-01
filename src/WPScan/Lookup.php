<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	VO\BaseVulnResultsVO,
	VO\Constants,
	VO\CoreVulnResultsVO,
	VO\PluginThemeVulnResultsVO,
	VO\VulnVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\{
	InvalidAssetTypeException
};
use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\{
	Common\PluginThemeVulnVO,
	Core
};

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	/**
	 * @inheritDoc
	 */
	public function run() :BaseVulnResultsVO {

		$look = $this->getLookup();

		switch ( $look->asset_type ) {

			case Constants::ASSET_TYPE_WP:
				$retriever = new Core\Retrieve();
				break;

			case Constants::ASSET_TYPE_PLUGIN:
				$retriever = new Plugins\Retrieve();
				break;

			case Constants::ASSET_TYPE_THEME:
				$retriever = new Themes\Retrieve();
				break;

			default:
				throw new InvalidAssetTypeException( 'Invalid type: '.var_export( $look->asset_type, true ) );
		}

		return $this->convertResultToCommon(
			$retriever->setConnection( $this->getConnection() )
					  ->setLookupVO( $look )
					  ->retrieve()
		);
	}

	/**
	 * @param Core\CoreVulnVO|PluginThemeVulnVO $result
	 */
	private function convertResultToCommon( $result ) :?BaseVulnResultsVO {
		if ( $this->getLookup()->asset_type === Constants::ASSET_TYPE_WP ) {
			$commonResult = new CoreVulnResultsVO();
			if ( !empty( $result ) ) {
				$commonResult->changelog_url = $result->changelog_url;
				$commonResult->released_at = strtotime( $result->release_date );
				$commonResult->status = $result->status;
				$commonResult->latest_version = $result->latest_version;
			}
		}
		else {
			$commonResult = new PluginThemeVulnResultsVO();
		}

		$commonResult->lookup = $this->getLookup();

		$commonResult->vulnerabilities = array_map(
			function ( $vul ) {
				$new = new VulnVO();
				$new->id = $vul->id;
				$new->title = $vul->title;
				$new->fixed_in = $vul->fixed_in;
				$new->references = $vul->references;
				$new->published_at = strtotime( $vul->published_date );
				$new->disclosed_at = strtotime( $vul->published_date );
				$new->created_at = strtotime( $vul->created_at );
				$new->updated_at = strtotime( $vul->updated_at );
				return $new->getRawData();
			},
			empty( $result ) ? [] : $result->getVulns()
		);

		return $commonResult;
	}
}