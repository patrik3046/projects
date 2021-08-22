<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<title>Eredmények</title>
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
			
			$sql = "SELECT * FROM meccsek ORDER BY meccsek.`Forduló`";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "
				<table class='tabella' id='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>Meccs ID</th>
						<th>Hazai csapat</th>
						<th>Eredmény</th>
						<th>Vendég csapat</th>";

			  	while($row = $result->fetch_assoc()) {
			  		echo "	<tr>
			  					<td>".$row["Meccs azonosítója"]."</td>
				  			  	<td>".$row["Hazai csapat"]."</td>
				  			  	<td>".$row["Eredmény"]."</td>
				  			  	<td>".$row["Vendég csapat"]."</td>
				  		  	</tr>";
			  	}
			  	echo "</table>";
			}

		 	CloseCon($conn); 
		?>

		<div calss="container" style="width: 75%; margin:20px 200px;">

			<?php
				$conna = OpenCon();
				$sqla = "SELECT * FROM tabella";
				$resulta = $conna->query($sqla);

				if ($resulta->num_rows > 0) {
					$d=0;
					$nd=0;
				  	while($rowa = $resulta->fetch_assoc()) {
			  			$d += $rowa["Döntetlenek"];
			  			$nd += $rowa["Győzelmek"];
			  		}
				}

		 		CloseCon($conna); 

				$dataPoints = array(
					array("label"=> "Döntetlenek", "y"=> $d),
					array("label"=> "Győzelmek/Vereségek", "y"=> $nd)
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
			text: "Eredmények alakulása"
		},
		axisY: {
			suffix: "",
			scaleBreaks: {
				autoCalculate: true
			}
		},
		data: [{
			type: "column",
			yValueFormatString: "#,##0",
			indexLabel: "{y}",
			indexLabelPlacement: "inside",
			indexLabelFontColor: "white",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
	}
</script>