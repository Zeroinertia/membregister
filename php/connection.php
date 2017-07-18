<?php
	$host			= "localhost";
	$username	= "root";
	$password	= "";
	$database	= "membregister";

	$connection = mysqli_connect($host, $username, $password, $database) or die($host . " connection error: " . mysqli_error());
	$year = "2017";
?>
