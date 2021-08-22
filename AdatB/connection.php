<?php
	function OpenCon(){
	 	$dbhost = "localhost";
		$dbuser = "patrick";
		$dbpass = "admin";
		$db = "otp_bank_liga";
		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

	 	return $conn;
	 }
	 
	function CloseCon($conn){
	 	$conn -> close();
 	}
 ?>