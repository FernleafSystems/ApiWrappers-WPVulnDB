<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\WPVDB;

use FernleafSystems\ApiWrappers\WpVulnDb\Common\VO\{
	Constants,
	CoreVulnResultsVO,
	PluginThemeVulnResultsVO,
	VulnVO
};

class Retrieve extends Api {

	public function retrieve() :null|CoreVulnResultsVO|PluginThemeVulnResultsVO {
		$vulns = $this->getVO();
		$vulns->lookup = $this->getLookupVO();

		if ( $this->req()->isLastRequestSuccess() ) {
			$items = [];
			foreach ( $this->extractVulnerabilitiesFromResponse() as $vulnItem ) {
				$vuln = new VulnVO();
				$vuln->id = $vulnItem[ 'id' ] ?? '';
				$vuln->title = $vulnItem[ 'name' ];
				$vuln->description = $vulnItem[ 'description' ];
				$vuln->operator = $vulnItem[ 'operator' ] ?? [];
				$vuln->references = [
					$vulnItem[ 'source' ]
				];
				$items[] = $vuln;
			}
			$vulns->vulnerabilities = $items;
		}
		else {
			error_log( var_export( $vulns->getRawData(), true ) );
		}

		return $vulns;
	}

	protected function getVO() :CoreVulnResultsVO|PluginThemeVulnResultsVO {
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
		$vo->provider = Constants::PROVIDER_WPVDB;
		return $vo;
	}

	protected function getUrlEndpoint() :string {
		$lookup = $this->getLookupVO();
		return sprintf( '%s/%s',
			$lookup->asset_type === Constants::ASSET_TYPE_WP ? 'core' : $lookup->asset_type,
			$lookup->asset_slug
		);
	}
}