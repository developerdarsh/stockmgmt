<?php 
    $Protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off' || $_SERVER['SERVER_PORT']==443) ? "https://" : "http://";		
    $SITEURL = $Protocol.$_SERVER['HTTP_HOST']."/test/darshit/";
		
	define('SITEURL', $SITEURL);
	define('SITENAME','Test Darshit');
	define('SITETITLE','TestDarshit');
	define('ADMINTITLE','TestDarshit Admin');
	
	define('CURR', '$');				

?>