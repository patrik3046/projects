<?php
	$id = $_GET['q'];
	include 'connection.php';	
	$conn2 = OpenCon();
	$sqlupd = "SELECT * FROM (meccsek JOIN tabella ON meccsek.`Hazai csapat` = tabella.`Csapat neve`) WHERE meccsek.`Meccs azonosítója` =".$id;
	$resultupd = $conn2->query($sqlupd);
	if ($resultupd->num_rows > 0) {
	  	while($rowupd = $resultupd->fetch_assoc()) {
  			$er = explode('-', $rowupd["Eredmény"]);
  			$gy = 0;
  			$d = 0;
  			$v = 0;
  			$p = 0;
  			if((int)$er[0] > (int)$er[1]){
  				$gy++;
  				$p = 3;
  			} else if((int)$er[0] < (int)$er[1]){
  				$v++;
  			} else {
  				$d++;
  				$p++;
  			}
  			$sql3 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd["Lejátszott fordulók"]-1).",tabella.`Győzelmek`=".($rowupd["Győzelmek"]-$gy).",tabella.`Döntetlenek`=".($rowupd["Döntetlenek"]-$d).",tabella.`Vereségek`=".($rowupd["Vereségek"]-$v).",tabella.`Lőtt gólok`=".($rowupd["Lőtt gólok"]-(int)$er[0]).",tabella.`Kapott Gólok`=".($rowupd["Kapott Gólok"]-(int)$er[1]).",tabella.`Gólkülönbség`=".($rowupd["Gólkülönbség"]-((int)$er[0]-(int)$er[1])).",tabella.`Pontok`=".($rowupd["Pontok"]-$p)." WHERE tabella.`Csapat neve` ='".$rowupd["Hazai csapat"]."'";
  			mysqli_query($conn2, $sql3);
	  	}
	 }
	CloseCon($conn2);

	$conn3 = OpenCon();
	$sqlupd3 = "SELECT * FROM (meccsek JOIN tabella ON meccsek.`Vendég csapat` = tabella.`Csapat neve`) WHERE meccsek.`Meccs azonosítója` =".$id;
	$resultupd3 = $conn3->query($sqlupd3);
	if ($resultupd3->num_rows > 0) {
	  	while($rowupd3 = $resultupd3->fetch_assoc()) {
  			$er = explode('-', $rowupd3["Eredmény"]);
  			$gy = 0;
  			$d = 0;
  			$v = 0;
  			$p = 0;
  			if((int)$er[0] < (int)$er[1]){
  				$gy++;
  				$p = 3;
  			} else if((int)$er[0] > (int)$er[1]){
  				$v++;
  			} else {
  				$d++;
  				$p++;
  			}
  			$sql4 = "UPDATE tabella SET tabella.`Lejátszott fordulók`=".($rowupd3["Lejátszott fordulók"]-1).",tabella.`Győzelmek`=".($rowupd3["Győzelmek"]-$gy).",tabella.`Döntetlenek`=".($rowupd3["Döntetlenek"]-$d).",tabella.`Vereségek`=".($rowupd3["Vereségek"]-$v).",tabella.`Lőtt gólok`=".($rowupd3["Lőtt gólok"]-(int)$er[1]).",tabella.`Kapott Gólok`=".($rowupd3["Kapott Gólok"]-(int)$er[0]).",tabella.`Gólkülönbség`=".($rowupd3["Gólkülönbség"]-((int)$er[1]-(int)$er[0])).",tabella.`Pontok`=".($rowupd3["Pontok"]-$p)." WHERE tabella.`Csapat neve` ='".$rowupd3["Vendég csapat"]."'";
  			mysqli_query($conn3, $sql4);
	  	}
	 }
	CloseCon($conn3);

	$conn = OpenCon();
	$sql = "DELETE FROM meccsek WHERE meccsek.`Meccs azonosítója` = ".$id;
	mysqli_query($conn, $sql);
	CloseCon($conn);
?>