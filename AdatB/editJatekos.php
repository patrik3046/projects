<?php
	include 'connection.php';
	if(isset($_POST["idjatekos1"]) && isset($_POST["csapatcs"]) && isset($_POST["posztcs"]) && isset($_POST["jatekosnevecs"])){
		$id = $_POST["idjatekos1"];
		$csapat = $_POST["csapatcs"];
		$poszt = $_POST["posztcs"];
		$nev = $_POST["jatekosnevecs"];

		$connd = OpenCon();
		$sqld = "SELECT * FROM (jatekosok JOIN csapatok ON jatekosok.Csapat = csapatok.Név) WHERE jatekosok.`Személyi szám` = ".$id;
		$resultd = $connd->query($sqld);
		
		if ($resultd->num_rows > 0) {
		  	while($rowd = $resultd->fetch_assoc()) {
		  		switch ($rowd["Poszt"]) {
		  			case 'Kapus':
		  				$ujertek = $rowd["Kapusok"] - 1;
		  				$poszt2="Kapusok";
		  				break;
		  			case 'Támadó':
		  				$ujertek = $rowd["Támadók"] - 1;
		  				$poszt2 = "Támadók";
		  				break;
		  			case 'Középpályás':
		  				$ujertek = $rowd["Középpályások"] - 1;
		  				$poszt2 = "Középpályások";
		  				break;
		  			case 'Védő':
		  				$ujertek = $rowd["Védők"] - 1;
		  				$poszt2 = "Védők";
		  				break;
		  		}
		  		$sqld2 = "UPDATE csapatok SET csapatok.".$poszt2."=".$ujertek." WHERE csapatok.Név ='".$rowd["Név"]."'";
		  		mysqli_query($connd, $sqld2);
		  	}
		}
		CloseCon($connd);

		$conn = OpenCon();
		$sql = "DELETE FROM jatekosok WHERE jatekosok.`Személyi szám` = ".$id;
		mysqli_query($conn, $sql);
		CloseCon($conn);

		$conn2 = OpenCon();
		$sql2 = "SELECT * FROM csapatok WHERE csapatok.Név = '".$csapat."'";
		$result2 = $conn2->query($sql2);
		if ($result2->num_rows > 0) {
		  	while($row2 = $result2->fetch_assoc()) {
		  		switch ($poszt) {
		  			case 'Kapus':
		  				$ujertek = $row2["Kapusok"] + 1;
		  				$poszt1="Kapusok";
		  				break;
		  			case 'Támadó':
		  				$ujertek = $row2["Támadók"] + 1;
		  				$poszt1 = "Támadók";
		  				break;
		  			case 'Középpályás':
		  				$ujertek = $row2["Középpályások"] + 1;
		  				$poszt1 = "Középpályások";
		  				break;
		  			case 'Védő':
		  				$ujertek = $row2["Védők"] + 1;
		  				$poszt1 = "Védők";
		  				break;
		  		}
		  		$sql3 = "UPDATE csapatok SET csapatok.`".$poszt1."`=".$ujertek." WHERE csapatok.`Név` ='".$csapat."'";
		  			mysqli_query($conn2, $sql3);
		  	}
		  	CloseCon($conn2);

			$conn = OpenCon();
			$sql = "INSERT INTO jatekosok (`Jétékos neve`, `Személyi szám`, `Csapat`,`Poszt`) VALUES ('".$nev."',".$id.",'".$csapat."', '".$poszt."')";
			mysqli_query($conn, $sql);

			header("Location: edit.php"); 
			exit();
		}
	} else {
		//echo "<script language='javascript'>alert('A megadott adatok hibásak, vagy már az adatbázis részei!');</script>";
		header("Location: edit.php"); 
		exit();
	}
?>