<?php
	$id = $_GET['q'];
	include 'connection.php';	
	$conn2 = OpenCon();
	$sqlupd = "SELECT * FROM (jatekosok JOIN csapatok ON jatekosok.Csapat = csapatok.Név) WHERE jatekosok.`Személyi szám` = ".$id;
	$resultupd = $conn2->query($sqlupd);
	
	if ($resultupd->num_rows > 0) {
	  	while($rowupd = $resultupd->fetch_assoc()) {
	  		switch ($rowupd["Poszt"]) {
	  			case 'Kapus':
	  				$ujertek = $rowupd["Kapusok"] - 1;
	  				$poszt="Kapusok";
	  				break;
	  			case 'Támadó':
	  				$ujertek = $rowupd["Támadók"] - 1;
	  				$poszt = "Támadók";
	  				break;
	  			case 'Középpályás':
	  				$ujertek = $rowupd["Középpályások"] - 1;
	  				$poszt = "Középpályások";
	  				break;
	  			case 'Védő':
	  				$ujertek = $rowupd["Védők"] - 1;
	  				$poszt = "Védők";
	  				break;
	  		}
	  		$sql3 = "UPDATE csapatok SET csapatok.".$poszt."=".$ujertek." WHERE csapatok.Név ='".$rowupd["Név"]."'";
	  		mysqli_query($conn2, $sql3);
	  	}
	}
	CloseCon($conn2);

	$conn = OpenCon();
	$sql = "DELETE FROM jatekosok WHERE jatekosok.`Személyi szám` = ".$id;
	mysqli_query($conn, $sql);
	CloseCon($conn);
	
?>