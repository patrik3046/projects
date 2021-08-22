<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel='stylesheet' href='Style.css'>
		<script type="text/javascript" src="scriptek.js"></script>
		<title>OTP bank liga</title>
	</head>
	<body>
		<?php
			include 'connection.php';		
			$conn = OpenCon();
		?>
		<div class='container'>
			<a href="index.php" class="btn">Főoldal</a>
		    <a href="eredmenyek.php" class="btn">Eredmények</a>
		    <a href="csapatok.php" class="btn">Csapatok</a>
		    <a href="jatekosok.php" class="btn">Játékosok</a>
		    <a href="stat.php" class="btn">Statisztikák</a>
		    <a href="edit.php" class="btn">Adatok szerkesztése</a>
		</div>
		<div class="container" style="margin-top:20px;">
			<div class="addData">
				<form action="addJatekos.php" method="post" id="addJatekos" name="addJatekos">
					<h1>Játékos hozzáadása</h1>
					<input type="text" name="nev"/ placeholder="Játékos neve">
					<?php
						$sql = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							echo " <select name='csapat' id='csapat'>";
						  	while($row = $result->fetch_assoc()) {
						  		echo "<option>".$row["Név"]."</option>";
						  	}
						  	echo "</select>";
						}

						$sql2 = "SELECT jatekosok.Poszt FROM jatekosok GROUP BY jatekosok.Poszt ORDER BY jatekosok.Poszt";
						$result2 = $conn->query($sql2);

						if ($result2->num_rows > 0) {
							echo " <select name='poszt' id='poszt'>";
						  	while($row2 = $result2->fetch_assoc()) {
						  		echo "<option>".$row2["Poszt"]."</option>";
						  	}
						  	echo "</select>";
						}
					?>
					<br><br>
					<input type="submit" name="jatekosHozzaad" value="Hozzáadás"/>
				</form>
			</div>

			<div class="addData">
				<h1>Játékos törlése</h1>
				<?php
					$sql5 = "SELECT * FROM jatekosok ORDER BY jatekosok.`Személyi szám`";
					$result5 = $conn->query($sql5);

					if ($result5->num_rows > 0) {
						echo "<label>ID:</label><select name='idjatekos' id='idjatekos' onchange='jatekosKiir(this.value);'>";
						$poszt='';
						$nev='';
						$i=0;
						$csapat='';
					  	while($row5 = $result5->fetch_assoc()) {
					  		if($i == 0){
					  			$poszt = $row5["Poszt"];
					  			$csapat = $row5["Csapat"];
					  			$nev = $row5["Jétékos neve"];
					  			$i++;
					  		}
					  		echo "<option>".$row5["Személyi szám"]."</option>";
					  	}
					  	echo "</select><br>
					  		<div style='text-align:left;padding-left:500px;'>
						  		<label id='jatekosneve'>Játékos neve: ".$nev."</label><br>
						  		<label id='jatekoscsapata'> Játékos csapata: ".$csapat."</label><br>
						  		<label id='jatekosposztja'> Játékos posztja: ".$poszt."</label>
					  		</div>
					  	";
					}
				?>
				<br>
				<input type="button" name="torles" value="Törlés"/ onclick="document.getElementById('jatekosTorlesModal').style.display='block'">
			</div>

			<div id="jatekosTorlesModal" class="modal">
				<div class="modal-content">
					<div class="modal-container">
						<div style="padding-top:10px; text-align: center; display: inline-block;">
						  <label style="  margin-left: 30px;">Biztosan törlöd a kijelölt játékost?<br>
						  <input type="button" class="gomb jt" name="jatekosTorol" value="Igen" style="margin-left: 40px;" onclick="jatekosTorles()">
						  <input type="button" class="gomb" style="  margin-left: 30px;" name="exit" value="Mégsem" onclick="document.getElementById('jatekosTorlesModal').style.display='none'">
						</div>
					</div>
				</div>
			</div>

			<div class="addData">
				<form action="editJatekos.php" method="post">
					<h1>Játékos szerkesztése</h1>
					<?php
						$sq = "SELECT * FROM jatekosok ORDER BY jatekosok.`Személyi szám`";
						$resul = $conn->query($sq);

						if ($resul->num_rows > 0) {
							echo "<label>ID:</label><select name='idjatekos1' id='idjatekos1' onchange='jatekosKiir1(this.value);'>";
							$poszt='';
							$nev='';
							$i=0;
							$csapat='';
						  	while($ro = $resul->fetch_assoc()) {
						  		if($i == 0){
						  			$poszt = $ro["Poszt"];
						  			$csapat = $ro["Csapat"];
						  			$nev = $ro["Jétékos neve"];
						  			$i++;
						  		}
						  		echo "<option>".$ro["Személyi szám"]."</option>";
						  	}
						  	echo "</select><br>
						  		<div>
							  		<input type='text' name='jatekosnevecs' id='jatekosnevecs' value='".$nev."'/>";

									$sqlcs = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
									$resultcs = $conn->query($sqlcs);

									if ($resultcs->num_rows > 0) {
										echo " <select name='csapatcs' id='csapatcs'>";
									  	while($rowcs = $resultcs->fetch_assoc()) {
									  		echo "<option";
											if($csapat == $rowcs["Név"]){
									  			echo " selected";
									  		}
									  		echo " id='".$rowcs["Név"]."'>".$rowcs["Név"]."</option>";
									  	}
									  	echo "</select>";
									}

									$sqlcs2 = "SELECT jatekosok.Poszt FROM jatekosok GROUP BY jatekosok.Poszt ORDER BY jatekosok.Poszt";
									$resultcs2 = $conn->query($sqlcs2);

									if ($resultcs2->num_rows > 0) {
										echo " <select name='posztcs' id='posztcs'>";
									  	while($rowcs2 = $resultcs2->fetch_assoc()) {
									  		echo "<option";
									  		if($poszt == $rowcs2["Poszt"]){
									  			echo " selected";
									  		}
									  		echo" id='".$rowcs2["Poszt"]."'>".$rowcs2["Poszt"]."</option>";
									  	}
									  	echo "</select>";
									}

						  		echo "</div>";
						}
					?>
					<br>
					<input type="submit" name="jatekosSzerkeszt" value="Szerkeszt"/>
				</form>
			</div>

			<div class="addData">
				<form action="addMeccs.php" method="post" id="addMeccs" name="addMeccs">
					<h1>Meccs hozzáadása</h1>
					<?php
						$sql3 = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
						$result3 = $conn->query($sql3);

						if ($result3->num_rows > 0) {
							echo "<label>Hazai csapat</label><select name='hcsapat' id='hcsapat' style='margin-left: 0;margin-right: 30px;'>";
						  	while($row3 = $result3->fetch_assoc()) {
						  		echo "<option>".$row3["Név"]."</option>";
						  	}
						  	echo "</select>";
						}
						
						$sql4 = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
						$result4 = $conn->query($sql4);

						if ($result4->num_rows > 0) {
							echo "<label>Vendég csapat</label><select name='vcsapat' id='vcsapat' style='margin-left: 0;'>";
						  	while($row4 = $result4->fetch_assoc()) {
						  		echo "<option>".$row4["Név"]."</option>";
						  	}
						  	echo "</select>";
						}
					?>
					<br>
					<label>Eredmény:</label>
					<input type="number" name="hgol" placeholder="Hazai gólok száma" />
					<label>-</label>
					<input type="number" name="vgol" placeholder="Vendég gólok száma" style="margin-left: 0;" />
					<br>
					<input type="number" name="ford" placeholder="Forduló"/>
					<br><br>
					<input type="submit" name="meccsHozzaad" value="Hozzáadás"/>
				</form>
			</div>

			<div class="addData">
				<h1>Meccs törlése</h1>
				<?php
					$sql6 = "SELECT * FROM meccsek ORDER BY meccsek.`Meccs azonosítója`";
					$result6 = $conn->query($sql6);

					if ($result6->num_rows > 0) {
						echo "<label>ID:</label><select name='idmeccs' id='idmeccs' onchange='meccsKiir(this.value);'>";
						$hazaicsapat='';
						$eredmeny='';
						$i=0;
						$vendegcsapat='';
						$fordulo = 0;
					  	while($row6 = $result6->fetch_assoc()) {
					  		if($i == 0){
					  			$hazaicsapat = $row6["Hazai csapat"];
					  			$eredmeny = $row6["Eredmény"];
					  			$vendegcsapat = $row6["Vendég csapat"];
					  			$fordulo = $row6["Forduló"];
					  			$i++;
					  		}
					  		echo "<option>".$row6["Meccs azonosítója"]."</option>";
					  	}
					  	echo "</select><br>
					  		<div style='text-align:left;padding-left:500px;'>
						  		<label id='hazaicsapat'>Hazai csapat: ".$hazaicsapat."</label><br>
						  		<label id='vendegcsapat'> Vendég csapat: ".$vendegcsapat."</label><br>
						  		<label id='eredmeny'> Eredmény: ".$eredmeny."</label><br>
						  		<label id='fordulo'> Forduló: ".$fordulo."</label>
					  		</div>
					  	";
					}
				?>
				<br>
				<input type="button" name="meccsTorol" value="Törlés" onclick="document.getElementById('meccsTorlesModal').style.display='block'" />
			</div>

			<div id="meccsTorlesModal" class="modal">
				<div class="modal-content">
					<div class="modal-container">
						<div style="padding-top:10px; text-align: center; display: inline-block;">
						  <label style="  margin-left: 30px;">Biztosan törlöd a kijelölt meccset?<br>
						  <input type="button" class="gomb" name="meccsTorles" value="Igen" style="margin-left: 40px;" onclick="meccsTorles()">
						  <input type="button" class="gomb" style="  margin-left: 30px;" name="exit" value="Mégsem" onclick="document.getElementById('meccsTorlesModal').style.display='none'">
						</div>
					</div>
				</div>
			</div>

			<div class="addData">
				<form action="editMeccs.php" method="post">
					<h1>Meccs szerkesztése</h1>
					<?php
						$s = "SELECT * FROM meccsek ORDER BY meccsek.`Meccs azonosítója`";
						$resu = $conn->query($s);

						if ($resu->num_rows > 0) {
							echo "<label>ID:</label><select name='idmeccs1' id='idmeccs1' onchange='meccsKiir1(this.value);'>";
							$hcsapat='';
							$vcsapat='';
							$i=0;
							$er='';
							$for = 0;
						  	while($r = $resu->fetch_assoc()) {
						  		if($i == 0){
						  			$hcsapat = $r["Hazai csapat"];
						  			$vcsapat = $r["Vendég csapat"];
						  			$er = $r["Eredmény"];
						  			$for = $r["Forduló"];
						  			$i++;
						  			$golok = explode("-", $er);
						  		}
						  		echo "<option>".$r["Meccs azonosítója"]."</option>";
						  	}
						  	echo "</select><br>
						  		<div>";
									$sqlc = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
									$resultc = $conn->query($sqlc);

									if ($resultc->num_rows > 0) {
										echo " <select name='csapat1' id='csapat1'>";
									  	while($rowc = $resultc->fetch_assoc()) {
									  		echo "<option";
											if($hcsapat == $rowc["Név"]){
									  			echo " selected";
									  		}
									  		echo " id='".$rowc["Név"]."1'>".$rowc["Név"]."</option>";
									  	}
									  	echo "</select>";
									}

									$sqlc2 = "SELECT csapatok.Név FROM csapatok ORDER BY csapatok.`Név`";
									$resultc2 = $conn->query($sqlc2);

									if ($resultc2->num_rows > 0) {
										echo " <select name='csapat2' id='csapat2'>";
									  	while($rowc2 = $resultc2->fetch_assoc()) {
									  		echo "<option";
											if($vcsapat == $rowc2["Név"]){
									  			echo " selected";
									  		}
									  		echo " id='".$rowc2["Név"]."2'>".$rowc2["Név"]."</option>";
									  	}
									  	echo "</select>";
									}
						  		echo "<br>
						  			<input type='number' id='hgolc' name='hgol1' value='".$golok[0]."'/>
						  			<input type='number' id='vgolc' name='vgol1' value='".$golok[1]."'/>
						  			<input type='number' id='forc' name='for1' value='".$for."'/>
						  			</div>";
						}
					?>
					<br>
					<input type="submit" name="jatekosSzerkeszt" value="Szerkeszt"/>
				</form>
			</div>

		</div>
		<?php CloseCon($conn);?>
	</body>
</html>