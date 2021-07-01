<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Common\VO;

class Constants {

	public const ASSET_TYPE_WP = 'wordpress';
	public const ASSET_TYPE_PLUGIN = 'plugin';
	public const ASSET_TYPE_THEME = 'theme';
	public const ASSET_TYPES = [ self::ASSET_TYPE_WP, self::ASSET_TYPE_PLUGIN, self::ASSET_TYPE_THEME ];
	public const PROVIDER_WPSCAN = 'wpscan';
	public const PROVIDER_PATCHSTACK = 'patchstack';
}