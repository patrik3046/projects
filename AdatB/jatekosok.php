<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<title>Játékosok</title>
	</head>
	<body>
		<div class='container'>
			<a href="index.php" class="btn">Főoldal</a>
		    <a href="eredmenyek.php" class="btn">Eredmények</a>
		    <a href="csapatok.php" class="btn">Csapatok</a>
		    <a href="jatekosok.php" class="btn">Játékosok</a>
		     <a href="stat.php" class="btn">Statisztikák</a>
		    <a href="edit.php" class="btn">Adatok szerkesztése</a>
		</div>
		<?php
			include 'connection.php';			
			$conn = OpenCon();
			if(isset($_GET['csapat'])){
				$csapat = $_GET['csapat'];
				$sql = "SELECT * FROM jatekosok WHERE jatekosok.Csapat='".$csapat."' ORDER BY jatekosok.`Jétékos neve`";
				$result = $conn->query($sql);
			} else {
				$sql = "SELECT * FROM jatekosok ORDER BY jatekosok.`Jétékos neve`";
				$result = $conn->query($sql);
			}

			if ($result->num_rows > 0) {
				echo "
				<table class='jatekosok' id='jatekosok' border='1' cellspacing='0' cellpadding='0'>
						<th>Személyi szám</th>
						<th>Név</th>
						<th>Csapat</th>
						<th>Poszt</th>";
			  	while($row = $result->fetch_assoc()) {
			  		echo "
			  			<tr>
			  			  	<td>".$row["Személyi szám"]."</td>
			  			  	<td>".$row["Jétékos neve"]."</td>
			  			  	<td>".$row["Csapat"]."</td>
			  			  	<td>".$row["Poszt"]."</td>
			  		  	 </tr>";
			  	}
			  	echo "</table>";
			}
			CloseCon($conn); 
		?>

		<div calss="container" style="width: 75%; margin:20px 200px;">

			<?php
				$connx = OpenCon();
				$sqlx= "SELECT * FROM csapatok";
				$resultx = $connx->query($sqlx);

				if ($resultx->num_rows > 0) {
					$kapus = 0;
					$vedo = 0;
					$kozep = 0;
					$tamado = 0;
				  	while($rowx = $resultx->fetch_assoc()) {
				  		$kapus += $rowx["Kapusok"];
				  		$vedo += $rowx["Védők"];
				  		$kozep += $rowx["Középpályások"];
				  		$tamado += $rowx["Támadók"];
				  	}
				}
				$ossz = $kapus + $vedo + $kozep + $tamado;
		 		CloseCon($connx); 

				$dataPoints = array(
					array("label"=> "Kapusok", "y"=> $kapus),
					array("label"=> "Védők", "y"=> $vedo),
					array("label"=> "Középpályások", "y"=> $kozep),
					array("label"=> "Támadók", "y"=> $tamado)
				);
			?>
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		</div>
	</body>
</html>

<script>
	window.onload = function () {
	 
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2",
		title: {
			text: "A posztokon játszó játkosok száma"
		},
		axisY: {
			suffix: "",
			scaleBreaks: {
				autoCalculate: true
			}
		},
		data: [{
			type: "column",
			yValueFormatString: "###",
			indexLabel: "{y}",
			indexLabelPlacement: "inside",
			indexLabelFontColor: "white",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
	}
</script>