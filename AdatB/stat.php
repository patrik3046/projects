<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<title>Statisztikák</title>
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
			
			$sql = "SELECT csapatok.Név,ROUND(AVG(csapatok.Kapusok),0) AS 'Kapusok száma',ROUND(AVG(csapatok.Védők),0) AS 'Védők száma',ROUND(AVG(csapatok.Középpályások),0) AS 'Középpályások száma',ROUND(AVG(csapatok.Támadók),0) AS 'Támadók száma' FROM csapatok RIGHT OUTER JOIN jatekosok ON csapatok.Név = jatekosok.Csapat GROUP BY jatekosok.Csapat";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "
				<table class='tabella' id='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>Csapat</th>
						<th>Kapusok száma</th>
						<th>Védők száma</th>
						<th>Középpályások száma</th>
						<th>Támadók száma</th>";
			  	while($row = $result->fetch_assoc()) {
			  		echo "
				  			<tr>
				  			  	<td>".$row["Név"]."</td>
				  			  	<td>".$row["Kapusok száma"]."</td>
				  			  	<td>".$row["Védők száma"]."</td>
				  			  	<td>".$row["Középpályások száma"]."</td>
				  			  	<td>".$row["Támadók száma"]."</td>
				  		  	 </tr>";
			  	}
			  	echo "</table>";
			}

			$sql2 = "SELECT tabella.`Csapat neve`,tabella.`Lőtt gólok` FROM tabella WHERE tabella.`Lőtt gólok` > (SELECT AVG(tabella.`Lőtt gólok`) FROM tabella) ORDER BY tabella.`Lőtt gólok` DESC";
			$result2 = $conn->query($sql2);

			if ($result2->num_rows > 0) {
				echo "
				<table class='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>Akik több gólt rúgtak az átlagnál</th>
						<th>Lőtt gólok</th>";
			  	while($row2 = $result2->fetch_assoc()) {
			  		echo "
				  			<tr>
				  			  	<td>".$row2["Csapat neve"]."</td>
				  			  	<td>".$row2["Lőtt gólok"]."</td>
				  		  	 </tr>";
			  	}
			  	echo "</table>";
			}


			$sql3 = "SELECT tabella.`Csapat neve`,tabella.`Kapott gólok` FROM tabella WHERE tabella.`Kapott gólok` > (SELECT AVG(tabella.`Kapott gólok`) FROM tabella) ORDER BY tabella.`Kapott gólok` DESC";
			$result3 = $conn->query($sql3);

			if ($result3->num_rows > 0) {
				echo "
				<table class='tabella' border='1' cellspacing='0' cellpadding='0'>
						<th>Akik több gólt kaptak az átlagnál</th>
						<th>Kapott gólok</th>";
			  	while($row3 = $result3->fetch_assoc()) {
			  		echo "
				  			<tr>
				  			  	<td>".$row3["Csapat neve"]."</td>
				  			  	<td>".$row3["Kapott gólok"]."</td>
				  		  	 </tr>";
			  	}
			  	echo "</table>";
			}

		 	CloseCon($conn); 
		?>
	</body>
</html>