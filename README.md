# WPVulnDB API Wrapper
API Wrapper for the WP VulnDB API

Uses the newer v3 API. Register with WP Vuln DB to obtain API Key/Token
https://wpvulndb.com/users/sign_up

Example:

```php
	use FernleafSystems\ApiWrappers\WpVulnDb;

	$oConn = new WpVulnDb\Connection();
	$oConn->api_key = 'abc123'; // Get this when you register
	$oPluginVuln = ( new WpVulnDb\Plugins\Retrieve() )
                  	->setConnection( $oConn )
                  	->filterByVersion( '5.1' )
                  	->filterBySlug( 'wp-simple-firewall' )
                  	->retrieve();
```

* When a vulnerability is found they can be enumerated from the array returned from
`$oPluginVuln->getVulns()`
* `null` will be returned if there are no vulnerabilities found for the particular 
slug and version so care must be taken to use the result of the request safely.
* It is not necessary to filter by version. If you omit this, then all available vulnerabilities
will be returned.