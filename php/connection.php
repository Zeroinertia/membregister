<?php
	$host			= "localhost";
	$username	= "root";
	$password	= "";
	$database	= "membregister";
	$_SESSION['superid'] = 0;

	$connection = mysqli_connect($host, $username, $password, $database) or die($host . " connection error: " . mysqli_error($connection));

	$connection->set_charset('utf8');

	//$year = "2017";

?>
