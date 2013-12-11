<?PHP
	 /*
	 * 	K.I.S.S
	 */

 
	@header('Content-type: text/html; charset=utf-8');
	@header("Cache-Control: private");
	


	ini_set('session.hash_function', 1);
	ini_set('session.gc_maxlifetime', 3600);
	ini_set('session_set_cookie_params', 3600);
		 

	//ini_set('session.cookie_domain', '.pracanowo.pl' );
		  
	require_once('my.session.php');
	$session = new Session();


	/* SESSION name */
	session_name('sas');
	session_start();
		 


?>