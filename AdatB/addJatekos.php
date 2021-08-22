<?php
	if(isset($_POST["nev"]) && isset($_POST["csapat"]) && isset($_POST["poszt"])){
		$name = $_POST['nev'];
		$csapat = $_POST['csapat'];
		$poszt = $_POST['poszt'];

		include 'connection.php';	
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
			$sql = "INSERT INTO jatekosok (`Jétékos neve`, `Személyi szám`, `Csapat`,`Poszt`) VALUES ('".$name."', Null ,'".$csapat."', '".$poszt."')";
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