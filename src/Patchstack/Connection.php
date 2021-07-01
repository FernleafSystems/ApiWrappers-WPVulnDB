<?php

namespace FernleafSystems\ApiWrappers\WpVulnDb\Patchstack;

class Connection extends \FernleafSystems\ApiWrappers\WpVulnDb\Common\Connection {

	const API_URL = 'https://patchstack.com/database/api/v%s/product';
	const API_VERSION = '2';
}