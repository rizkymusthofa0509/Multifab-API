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
	
	if (isset($_POST['email'])){

		$response 			 = array(); 

		$email = $_POST['email'];

		$buka_user           = mysql_fetch_array(mysql_query("SELECT idLogin,username,nama,badgeno,email,nomorhp,statusID,kategori,DEPID,BUID,site FROM login WHERE email='$email'"));
		$site                = $buka_user['site'];
		$ug1 				 = explode(",",$site);
		 
		for ($i=0; $i <= count($ug1)-1 ; $i++) { 
			$loop = $ug1[$i];
			$query_job = mysql_query("SELECT a.BUID, prefix, business_unit , concat(prefix,'-',business_unit) as description FROM m_business_unit a WHERE a.BUID='$loop' ")or die (mysql_error());
			$data_job     = mysql_fetch_array($query_job);
			$push['BUID'] = $data_job['BUID'];
			$push['prefix'] = $data_job['prefix'];
			$push['business_unit'] = $data_job['business_unit'];
			$push['description'] = $data_job['description']; 
			array_push($response, $push);

		 } 

	}else{

		$response 			 = array(); 

		$query_job = mysql_query("SELECT a.BUID, prefix, business_unit , concat(prefix,'-',business_unit) as description FROM m_business_unit a")or die (mysql_error());

		while ($data_job = mysql_fetch_array($query_job)) {
			$push['BUID'] = $data_job['BUID'];
			$push['prefix'] = $data_job['prefix'];
			$push['business_unit'] = $data_job['business_unit'];
			$push['description'] = $data_job['description']; 
			array_push($response, $push);
		}

	}

  
	echo json_encode($response);

?>