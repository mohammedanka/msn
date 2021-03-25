<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$db_name = "web";

	@mysql_connect($host, $user, $password);
	mysql_select_db($db_name);
?>