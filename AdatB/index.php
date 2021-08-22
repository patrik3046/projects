<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<script type="text/javascript" src="scriptek.js"></script>
		<title>OTP bank liga</title>
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
			
			$sql = "SELECT * FROM tabella ORDER BY tabella.Pontok DESC,tabella.`Lejátszott fordulók` ASC,tabella.Győzelmek DESC,tabella.Gólkülönbség DESC,tabella.`Lőtt gólok` DESC";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "
				<table class='tabella' id='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>H.</th>
						<th>Csapat</th>
						<th>M.</th>
						<th>Gy.</th>
						<th>D.</th>
						<th>V.</th>
						<th>L.G.</th>
						<th>K.G.</th>
						<th>G.K.</th>
						<th>Pontok</th>";
				$i = 0;
			  	while($row = $result->fetch_assoc()) {
			  		$i++;
			  		$nev = explode(" ",$row["Csapat neve"]);
			  		echo "
			  			<form action='jatekosok.php' id='submit' method='get' target='_blank'  name='".$nev[0]."'>
				  			<tr>
				  			  	<td>".$i."</td>
			  			  		<td style='cursor:pointer;' onclick='kuldes(`".$nev[0]."`);self.close();'>".$row["Csapat neve"]."
			  			  			<input type='text' id='csapat' name='csapat' hidden value='".$row["Csapat neve"]."'>
			  			  		</td>
				  			  	<td>".$row["Lejátszott fordulók"]."</td>
				  			  	<td>".$row["Győzelmek"]."</td>
				  			  	<td>".$row["Döntetlenek"]."</td>
				  			  	<td>".$row["Vereségek"]."</td>
				  			  	<td>".$row["Lőtt gólok"]."</td>
				  			  	<td>".$row["Kapott Gólok"]."</td>
				  			  	<td>".$row["Gólkülönbség"]."</td>
				  			  	<td>".$row["Pontok"]."</td>
				  		  	 </tr>
			  		  	</form>";
			  	}
			  	echo "</table>";
			}

		 	CloseCon($conn); 
		?>
		<br>

		<div calss="container" style="width: 75%; margin:20px 200px;">

			<?php
				$conn2 = OpenCon();
				$sql2 = "SELECT * FROM tabella";
				$result2 = $conn2->query($sql2);

				if ($result2->num_rows > 0) {
					$a1=0;$a2=0;$a3=0;$a4=0;$a5=0;$a6=0;$a7=0;$a8=0;$a9=0;$a10=0;$a11=0;$a12 = 0;
				  	while($row2 = $result2->fetch_assoc()) {
				  		switch ($row2["Csapat neve"]) {
				  			case 'Ferencvárosi TC':
				  				$a1 = $row2["Pontok"];
				  				break;
				  			case 'Kisvárda':
				  				$a2 = $row2["Pontok"];
				  				break;
				  			case 'MOL Fehérvár FC':
				  				$a3 = $row2["Pontok"];
				  				break;
				  			case 'MTK Budapest':
				  				$a4 = $row2["Pontok"];
				  				break;
				  			case 'Paks':
				  				$a5 = $row2["Pontok"];
				  				break;
				  			case 'Puskás Akadémia':
				  				$a6 = $row2["Pontok"];
				  				break;
				  			case 'Budafok':
				  				$a7 = $row2["Pontok"];
				  				break;
				  			case 'Zalaegerszeg':
				  				$a8 = $row2["Pontok"];
				  				break;
				  			case 'Diósgyőri VTK':
				  				$a9 = $row2["Pontok"];
				  				break;
				  			case 'Honvéd FC':
				  				$a10 = $row2["Pontok"];
				  				break;
				  			case 'Újpest':
				  				$a11 = $row2["Pontok"];
				  				break;
				  			case 'Mezőkövesd':
				  				$a12 = $row2["Pontok"];
				  				break;
				  		}
				  	}
				}

		 		CloseCon($conn2); 

				$dataPoints = array(
					array("label"=> "Ferencvárosi TC", "y"=> $a1),
					array("label"=> "Kisvárda", "y"=> $a2),
					array("label"=> "MOL Fehérvár FC", "y"=> $a3),
					array("label"=> "MTK Budapest", "y"=> $a4),
					array("label"=> "Paks", "y"=> $a5),
					array("label"=> "Puskás Akadémia", "y"=> $a6),
					array("label"=> "Budafok", "y"=> $a7),
					array("label"=> "Zalaegerszeg", "y"=> $a8),
					array("label"=> "Diósgyőri VTK", "y"=> $a9),
					array("label"=> "Honvéd FC", "y"=> $a10),
					array("label"=> "Újpest", "y"=> $a11),
					array("label"=> "Mezőkövesd", "y"=> $a12)
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
			text: "OTP bank liga pontok"
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