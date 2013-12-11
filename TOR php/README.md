TOR php
======

Remember to turn off auth in tor client


		ADD to PHP curl

		/* THIS IS TOR */
		curl_setopt ($init, CURLOPT_PROXY, '127.0.0.1:9050');
		curl_setopt ($init, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		/* END THIS IS TOR */