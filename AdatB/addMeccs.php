<?php
	$hcsapat = $_POST['hcsapat'];
	$vcsapat = $_POST['vcsapat'];
	$hgol = $_POST['hgol'];
	$vgol = $_POST['vgol'];
	$ford = $_POST['ford'];

	include 'connection.php';	
	$conn2 = OpenCon();
	$sql2 = "SELECT * FROM meccsek WHERE meccsek.Forduló = ".$ford;
	$result2 = $conn2->query($sql2);
	if ($result2->num_rows > 0){
		$bool = false;
		if ($result2->num_rows > 0) {
		  	while($row2 = $result2->fetch_assoc()) {
		  		if($row2["Hazai csapat"]."" == $hcsapat."" || $row2["Vendég csapat"]."" == $hcsapat."" || $row2["Hazai csapat"]."" == $vcsapat."" || $row2["Vendég csapat"]."" == $vcsapat.""){
		  			$bool = true;
		  			break;
		  		} else {
		  			continue;
		  		}
		  	}
		  	if($bool == false){
		  		$conn3 = OpenCon();
				$sqlupd = "SELECT * FROM tabella WHERE tabella.`Csapat neve` ='".$hcsapat."'";
				$resultupd = $conn3->query($sqlupd);
				if ($resultupd->num_rows > 0) {
				  	while($rowupd = $resultupd->fetch_assoc()) {
			  			$gy = 0;
			  			$d = 0;
			  			$v = 0;
			  			$p = 0;
			  			if($hgol > $vgol){
			  				$gy++;
			  				$p = 3;
			  			} else if($hgol < $vgol){
			  				$v++;
			  			} else {
			  				$d++;
			  				$p++;
			  			}
			  			$sql3 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd["Lejátszott fordulók"]+1).",tabella.`Győzelmek`=".($rowupd["Győzelmek"]+$gy).",tabella.`Döntetlenek`=".($rowupd["Döntetlenek"]+$d).",tabella.`Vereségek`=".($rowupd["Vereségek"]+$v).",tabella.`Lőtt gólok`=".($rowupd["Lőtt gólok"]+$hgol).",tabella.`Kapott Gólok`=".($rowupd["Kapott Gólok"]+$vgol).",tabella.`Gólkülönbség`=".($rowupd["Gólkülönbség"]+($hgol-$vgol)).",tabella.`Pontok`=".($rowupd["Pontok"]+$p)." WHERE tabella.`Csapat neve` ='".$hcsapat."'";
			  			mysqli_query($conn3, $sql3);
				  	}
				 }
				CloseCon($conn3);

				$conn4 = OpenCon();
				$sqlupd4 = "SELECT * FROM tabella WHERE tabella.`Csapat neve` ='".$vcsapat."'";
				$resultupd4 = $conn4->query($sqlupd4);
				if ($resultupd4->num_rows > 0) {
				  	while($rowupd4 = $resultupd4->fetch_assoc()) {
			  			$gy = 0;
			  			$d = 0;
			  			$v = 0;
			  			$p = 0;
			  			if($hgol < $vgol){
			  				$gy++;
			  				$p = 3;
			  			} else if($hgol > $vgol){
			  				$v++;
			  			} else {
			  				$d++;
			  				$p++;
			  			}
			  			$sql4 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd4["Lejátszott fordulók"]+1).",tabella.`Győzelmek`=".($rowupd4["Győzelmek"]+$gy).",tabella.`Döntetlenek`=".($rowupd4["Döntetlenek"]+$d).",tabella.`Vereségek`=".($rowupd4["Vereségek"]+$v).",tabella.`Lőtt gólok`=".($rowupd4["Lőtt gólok"]+$vgol).",tabella.`Kapott Gólok`=".($rowupd4["Kapott Gólok"]+$hgol).",tabella.`Gólkülönbség`=".($rowupd4["Gólkülönbség"]+($vgol-$hgol)).",tabella.`Pontok`=".($rowupd4["Pontok"]+$p)." WHERE tabella.`Csapat neve` ='".$vcsapat."'";
			  			mysqli_query($conn4, $sql4);
				  	}
				 }
				CloseCon($conn4);
		  		
				$conn = OpenCon();
				$sql = "INSERT INTO meccsek (`Meccs azonosítója`, `Hazai csapat`, `Vendég csapat`,`Eredmény`,`Forduló`) VALUES (Null,'".$hcsapat."', '".$vcsapat."', '".$hgol."-".$vgol."',".$ford.")";
				mysqli_query($conn, $sql);

				CloseCon($conn2);
				header("Location: edit.php"); 
				exit();
		  	} else {
		  		//echo "<script language='javascript'> alert('A megadott adatok hibásak, vagy már az adatbázis részei!');</script>";
				header("Location: edit.php"); 
				exit();
		  	}
		}
	} else if($vcsapat != $hcsapat){
  		$conn3 = OpenCon();
		$sqlupd = "SELECT * FROM tabella WHERE tabella.`Csapat neve` ='".$hcsapat."'";
		$resultupd = $conn3->query($sqlupd);
		if ($resultupd->num_rows > 0) {
		  	while($rowupd = $resultupd->fetch_assoc()) {
	  			$gy = 0;
	  			$d = 0;
	  			$v = 0;
	  			$p = 0;
	  			if($hgol > $vgol){
	  				$gy++;
	  				$p = 3;
	  			} else if($hgol < $vgol){
	  				$v++;
	  			} else {
	  				$d++;
	  				$p++;
	  			}
	  			$sql3 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd["Lejátszott fordulók"]+1).",tabella.`Győzelmek`=".($rowupd["Győzelmek"]+$gy).",tabella.`Döntetlenek`=".($rowupd["Döntetlenek"]+$d).",tabella.`Vereségek`=".($rowupd["Vereségek"]+$v).",tabella.`Lőtt gólok`=".($rowupd["Lőtt gólok"]+$hgol).",tabella.`Kapott Gólok`=".($rowupd["Kapott Gólok"]+$vgol).",tabella.`Gólkülönbség`=".($rowupd["Gólkülönbség"]+($hgol-$vgol)).",tabella.`Pontok`=".($rowupd["Pontok"]+$p)." WHERE tabella.`Csapat neve` ='".$hcsapat."'";
	  			mysqli_query($conn3, $sql3);
		  	}
		 }
		CloseCon($conn3);

		$conn4 = OpenCon();
		$sqlupd4 = "SELECT * FROM tabella WHERE tabella.`Csapat neve`='".$vcsapat."'";
		$resultupd4 = $conn4->query($sqlupd4);
		if ($resultupd4->num_rows > 0) {
		  	while($rowupd4 = $resultupd4->fetch_assoc()) {
	  			$gy = 0;
	  			$d = 0;
	  			$v = 0;
	  			$p = 0;
	  			if($hgol < $vgol){
	  				$gy++;
	  				$p = 3;
	  			} else if($hgol > $vgol){
	  				$v++;
	  			} else {
	  				$d++;
	  				$p++;
	  			}
	  			$sql4 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd4["Lejátszott fordulók"]+1).",tabella.`Győzelmek`=".($rowupd4["Győzelmek"]+$gy).",tabella.`Döntetlenek`=".($rowupd4["Döntetlenek"]+$d).",tabella.`Vereségek`=".($rowupd4["Vereségek"]+$v).",tabella.`Lőtt gólok`=".($rowupd4["Lőtt gólok"]+$vgol).",tabella.`Kapott Gólok`=".($rowupd4["Kapott Gólok"]+$hgol).",tabella.`Gólkülönbség`=".($rowupd4["Gólkülönbség"]+($vgol-$hgol)).",tabella.`Pontok`=".($rowupd4["Pontok"]+$p)." WHERE tabella.`Csapat neve` ='".$vcsapat."'";
	  			mysqli_query($conn4, $sql4);
		  	}
		 }
		CloseCon($conn4);
  		
		$conn = OpenCon();
		$sql = "INSERT INTO meccsek (`Meccs azonosítója`, `Hazai csapat`, `Vendég csapat`,`Eredmény`,`Forduló`) VALUES (Null,'".$hcsapat."', '".$vcsapat."', '".$hgol."-".$vgol."',".$ford.")";
		mysqli_query($conn, $sql);

		CloseCon($conn2);
		header("Location: edit.php"); 
		exit();
	}else{
		//echo "<script language='javascript'>alert('Töltsön ki minden mezőt!');</script>";
		header("Location: edit.php"); 
		exit();
	}
?>