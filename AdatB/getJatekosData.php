<?php
	$mysqli = new mysqli("localhost", "patrick", "admin", "otp_bank_liga");
	if($mysqli->connect_error) {
	  exit('Could not connect');
	}

	$sql = "SELECT * FROM jatekosok WHERE jatekosok.`Személyi szám` = ?";

	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s", $_GET['q']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($nev,$id, $ecsapat, $poszt);
	$stmt->fetch();
	$stmt->close();
	echo $nev.",".$ecsapat.",".$poszt;
?>