<?php
/*Open Connection*/

	$myServer = "localhost";
	$myUser   = "root";
	$myPass   = "4dmin@mf";
	$myDB     = "bms";

	//connection to the database
	$dbhandle = mysql_connect($myServer, $myUser, $myPass) or die(mysql_error());
	$selected = mysql_select_db($myDB, $dbhandle) or die(mysql_error());

?>