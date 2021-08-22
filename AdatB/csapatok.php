<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<script type="text/javascript" src="scriptek.js"></script>
		<title>Csapatok</title>
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
			
			$sql = "SELECT * FROM csapatok ORDER BY csapatok.`Név`";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "
				<table class='tabella' id='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>Név</th>
						<th>Vezető edző</th>
						<th>Igazolt játékosok</th>";

			  	while($row = $result->fetch_assoc()) {
			  		$nev = explode(" ",$row["Név"]);
			  		echo "
			  			<form action='jatekosok.php' id='submit' method='get' target='_blank'  name='".$nev[0]."'>
				  			<tr>
			  			  		<td style='cursor:pointer;' onclick='kuldes(`".$nev[0]."`);self.close();'>".$row["Név"]."
			  			  			<input type='text' id='csapat' name='csapat' hidden value='".$row["Név"]."'>
			  			  		</td>
				  			  	<td>".$row["Vezető edző"]."</td>
				  			  	<td>".jatekosokSzama($row["Név"])."</td>
				  		  	 </tr>
			  		  	</form>";
			  	}
			  	echo "</table>";
			}

			function jatekosokSzama($csapatNeve){
				$conn_jatekosokSzama = OpenCon();
			  	$sql_jatekosokSzama = "SELECT csapatok.Név,COUNT(jatekosok.Poszt) AS jatekosokSzama FROM csapatok RIGHT OUTER JOIN jatekosok ON csapatok.Név = jatekosok.Csapat GROUP BY jatekosok.Csapat";
				$result_jatekosokSzama = $conn_jatekosokSzama->query($sql_jatekosokSzama);

				if ($result_jatekosokSzama->num_rows > 0) {
					while($row3 = $result_jatekosokSzama->fetch_assoc()) {
						if ($row3["Név"] == $csapatNeve){
							return $row3["jatekosokSzama"];
						}
					}
				}

				return "";
			}

		 	CloseCon($conn); 
		?>
		<div calss="container" style="width: 75%; margin:20px 200px;">

			<?php
				$conna = OpenCon();
				$sqla = "SELECT * FROM csapatok";
				$resulta = $conna->query($sqla);

				if ($resulta->num_rows > 0) {
					$a1=0;$a2=0;$a3=0;$a4=0;$a5=0;$a6=0;$a7=0;$a8=0;$a9=0;$a10=0;$a11=0;$a12 = 0;
				  	while($rowa = $resulta->fetch_assoc()) {
				  		switch ($rowa["Név"]) {
				  			case 'Ferencvárosi TC':
				  				$a1 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Kisvárda':
				  				$a2 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'MOL Fehérvár FC':
				  				$a3 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'MTK Budapest':
				  				$a4 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Paks':
				  				$a5 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Puskás Akadémia':
				  				$a6 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Budafok':
				  				$a7 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Zalaegerszeg':
				  				$a8 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Diósgyőri VTK':
				  				$a9 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Honvéd FC':
				  				$a10 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Újpest':
				  				$a11 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  			case 'Mezőkövesd':
				  				$a12 = (int)$rowa["Kapusok"]+(int)$rowa["Támadók"]+(int)$rowa["Középpályások"]+(int)$rowa["Védők"];
				  				break;
				  		}
				  	}
				}

		 		CloseCon($conna); 

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
			text: "Csapatok játékosai"
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