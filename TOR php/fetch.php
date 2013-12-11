<?PHP



class minicurl {

	var $path_print_url;
	var $path_url;
	var $encoding;
	var $phpsessid;
	var $page_source;
	var $fetchvalue;
	var $curl_info;
	var $post_vars;
	var $cache_time;
	var $typ = 0;
	
	
	function GetContent($path_url, $typ = false) {
		
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $path_url);
		curl_setopt($init, CURLOPT_TIMEOUT, 10);
		
		if ($typ == true) {
			curl_setopt($init, CURLOPT_POST , 1);
			curl_setopt($init, CURLOPT_POSTFIELDS, @$this->post_vars);
		}else {
	       curl_setopt($init, CURLOPT_POST , 0);
		}
		
		/* THIS IS TOR */
		curl_setopt ($init, CURLOPT_PROXY, '127.0.0.1:9050');
		curl_setopt ($init, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		/* END THIS IS TOR */
		
		
		
		curl_setopt($init, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.8.0.4) Gecko/20060508 Firefox/1.5.0.4");
		curl_setopt($init, CURLOPT_HEADER, 0);

		curl_setopt($init, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($init, CURLOPT_COOKIE , false);
		curl_setopt($init, CURLOPT_REFERER, $path_url);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
		$source = curl_exec ($init);

		$this->curl_info = curl_getinfo($init);

		
		$this->page_source = $source;
		curl_close($init);
		return $this->page_source;
	}
	
	
}	

?>