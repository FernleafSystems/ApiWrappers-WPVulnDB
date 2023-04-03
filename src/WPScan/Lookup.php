<?php declare( strict_types=1 );

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPScan;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\{
	VO\Constants,
	VO\CoreVulnResultsVO,
	VO\PluginThemeVulnResultsVO,
	VO\VulnVO
};
use FernleafSystems\ApiWrappers\WpVulnDb\Exceptions\InvalidAssetTypeException;
use FernleafSystems\ApiWrappers\WpVulnDb\WPScan\Core;

class Lookup extends \FernleafSystems\ApiWrappers\WpVulnDb\Lookup {

	/**
	 * @inheritDoc
	 */
	public function run() :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {

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

	private function convertResultToCommon( $result ) :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {
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
				$vuln = new VulnVO();
				$vuln->id = $vul->id;
				$vuln->title = $vul->title;
				$vuln->fixed_in = $vul->fixed_in;
				$vuln->vuln_type = $vul->vuln_type;
				$vuln->references = $vul->references;
				$vuln->published_at = strtotime( $vul->published_date );
				$vuln->disclosed_at = strtotime( $vul->published_date );
				$vuln->created_at = strtotime( $vul->created_at );
				$vuln->updated_at = strtotime( $vul->updated_at );
				return $vuln;
			},
			empty( $result ) ? [] : $result->getVulns()
		);

		$commonResult->provider = 'wpscan';

		return $commonResult;
	}
}