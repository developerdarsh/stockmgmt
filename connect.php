<?php
	error_reporting(0);
	session_start();
	date_default_timezone_set('America/Los_Angeles');

	include("include/define.php");
	include("include/function.class.php");

	$db = new Functions();
?>