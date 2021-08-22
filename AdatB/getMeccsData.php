<?php
	$mysqli = new mysqli("localhost", "patrick", "admin", "otp_bank_liga");
	if($mysqli->connect_error) {
	  exit('Could not connect');
	}

	$sql = "SELECT * FROM meccsek WHERE meccsek.`Meccs azonosítója` = ?";

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $_GET['q']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($id, $hazai, $vendeg, $er, $for);
	$stmt->fetch();
	$stmt->close();
	echo $hazai.",".$vendeg.",".$er.",".$for;
?>