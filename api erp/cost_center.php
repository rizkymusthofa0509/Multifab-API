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


<?php
	header('Content-Type: application/json'); 
	
	$response 			 = array(); 

$query_job = mysql_query("SELECT jobcc, description, b.nama FROM erp_jobccview a
left join login b on b.idLogin=a.atasan_headof
left join usersite c on c.site=a.buID
where a.sts='Jadi Job' or a.sts='0' and a.atasan_headof >0 
group by a.jobcc")or die (mysql_error());

	while ($data_job = mysql_fetch_array($query_job)) {
		$push['data'] = $data_job['jobcc'];
		$push['desc'] = $data_job['description'];
		$push['pic']  = $data_job['nama'];

		array_push($response, $push);
	}
  
	echo json_encode($response);

?>