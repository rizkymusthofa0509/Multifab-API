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


		if (($_GET['username'] !="") AND ($_GET['password'] != "") AND ($_GET['status']!="") ){ 
		    $username = $_GET['username'];
		    $password = $_GET['password'];
			$status   = $_GET['status'];

			$cek      = mysql_query("SELECT * FROM login WHERE username='$username' ");
			if (mysql_num_rows($cek) == 0){
				/*Create Account*/
				$response['status']  = 200 ;
				$response['message'] = 'Akun Berhasil ditambahkan';
			}else{
				$response['status']  = 200 ;
				$response['message'] = 'Akun Tersedia';
			} 

		}else{

			$response['status']  = 400 ;
			$response['message'] = 'Data Tidak ditemukan';
		}
  
	echo json_encode($response);

?>