<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\{
	BaseVulnResultsVO,
	Constants,
	CoreVulnResultsVO,
	PluginThemeVulnResultsVO,
	VulnVO
};

class Retrieve extends Api {

	/**
	 * @return BaseVulnResultsVO|CoreVulnResultsVO|PluginThemeVulnResultsVO|null
	 */
	public function retrieve() :?BaseVulnResultsVO {
		$vulns = $this->getVO();
		$vulns->lookup = $this->getLookupVO();

		if ( $this->req()->isLastRequestSuccess() ) {
			$items = [];
			foreach ( $this->extractVulnerabilitiesFromResponse() as $vulnItem ) {
				$vuln = new VulnVO();
				$vuln->id = $vulnItem[ 'id' ];
				$vuln->title = $vulnItem[ 'title' ];
				$vuln->description = $vulnItem[ 'description' ];
				$vuln->vuln_type = $vulnItem[ 'vuln_type' ];
				$vuln->fixed_in = $vulnItem[ 'fixed_in' ] ?? '';
				$vuln->affected_in = $vulnItem[ 'affected_in' ] ?? '';
				$vuln->patched_in_ranges = $vulnItem[ 'patched_in_ranges' ] ?? [];
				$vuln->references = [
					$vulnItem[ 'direct_url' ]
				];
				$vuln->disclosed_at = strtotime( $vulnItem[ 'disclosure_date' ] );
				$vuln->created_at = strtotime( $vulnItem[ 'created_at' ] );
				$items[] = $vuln;
			}
			$vulns->vulnerabilities = $items;
		}
		else {
			error_log( var_export( $vulns->getRawData(), true ) );
		}

		return $vulns;
	}

	protected function getVO() :BaseVulnResultsVO {
		switch ( $this->getLookupVO()->asset_type ) {

			case Constants::ASSET_TYPE_WP:
				$vo = new CoreVulnResultsVO();
				break;

			case Constants::ASSET_TYPE_PLUGIN:
			case Constants::ASSET_TYPE_THEME:
			default:
				$vo = new PluginThemeVulnResultsVO();
				break;
		}
		$vo->provider = 'patchstack';
		return $vo;
	}

	protected function getUrlEndpoint() :string {
		$lookup = $this->getLookupVO();
		return sprintf( '%s/%s/%s', $lookup->asset_type, $lookup->asset_slug, $lookup->asset_version );
	}
}