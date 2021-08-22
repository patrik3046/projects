<%@page language="java" contentType="text/html" pageEncoding="UTF-8" %>
<%@ page import="java.sql.*" %>

<!DOCTYPE html>
<html>
	<head>
	   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	   <link rel="stylesheet" href="style.css">
	   <title>2048</title>
	</head>
	<body>
		<center>
		<%!	
			public int mapsize = 5;
			public int level = 11;
		   	public String mode = "number";
		   	public int record = 20;
		%>
		<%
		    if(request.getParameter("mode") != null && request.getParameter("mapsize") != null && request.getParameter("level") != null){
				mapsize = Integer.parseInt(request.getParameter("mapsize"));
				level = Integer.parseInt(request.getParameter("level"));
		    	mode = request.getParameter("mode");
			}
			%>
	   	<div id="menuPane" class="menupane">
	   		<label><h1>2048</h1></label>
		   	<input type="button" value="Játék" onclick="openGame();"><br><br>
		   	<input type="button" value="Beállítások" onclick="openSettings();">
		</div>
	   	<div id="settingsPane" class="settingspane" style="display: none">
	   		<label><h1>Beállítások</h1></label>
			<form action="index.jsp" name="settingsForm">
				<div>
					<label>Játékmód</label>
					 <select name="mode" id="modeChoiceBox"> 
					 	<%if(mode.equals("number")){%>
						 	<option value="number" selected>Számok</option>
						  	<option value="letter">Betűk</option>
					  	<%} else {%>
						  	<option value="number">Számok</option>
						  	<option value="letter" selected>Betűk</option>
					  	<%}%>
					</select>
				</div>
				<br>
				<div>
					<label>Pályaméret</label>
					<select name="mapsize" id="mapsizeChoiceBox">
						<%if(mapsize == 5){%>
						  	<option value="5" selected>5x5</option>
						  	<option value="6">6x6</option>
						  	<option value="8">8x8</option>
					  	<%} else if(mapsize == 6){%>
					  		<option value="5">5x5</option>
					  		<option value="6" selected>6x6</option>
					  		<option value="8">8x8</option>
					  	<%} else if(mapsize == 8){%>
					  		<option value="5">5x5</option>
					  		<option value="6">6x6</option>
					  		<option value="8" selected>8x8</option>
					  	<%}%>
					</select>
				</div>
				<br>
				<div>
					<label>Szint</label>
					<select name="level" id="levelChoiceBox">
						<%if(level == 5){%>
						  	<option value="5" selected>5</option>
						  	<option value="6">6</option>
						  	<option value="7">7</option>
						  	<option value="8">8</option>
						  	<option value="9">9</option>
						  	<option value="10">10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 6){%>
					  		<option value="5">5</option>
						  	<option value="6" selected>6</option>
						  	<option value="7">7</option>
						  	<option value="8">8</option>
						  	<option value="9">9</option>
						  	<option value="10">10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 7){%>
					  		<option value="5">5</option>
						  	<option value="6">6</option>
						  	<option value="7" selected>7</option>
						  	<option value="8">8</option>
						  	<option value="9">9</option>
						  	<option value="10">10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 8){%>
					  		<option value="5">5</option>
						  	<option value="6">6</option>
						  	<option value="7">7</option>
						  	<option value="8" selected>8</option>
						  	<option value="9">9</option>
						  	<option value="10">10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 9){%>
					  		<option value="5">5</option>
						  	<option value="6">6</option>
						  	<option value="7">7</option>
						  	<option value="8">8</option>
						  	<option value="9" selected>9</option>
						  	<option value="10">10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 10){%>
					  		<option value="5">5</option>
						  	<option value="6">6</option>
						  	<option value="7">7</option>
						  	<option value="8">8</option>
						  	<option value="9">9</option>
						  	<option value="10" selected>10</option>
						  	<option value="11">11</option>
					  	<%} else if(level == 11){%>
					  		<option value="5">5</option>
						  	<option value="6">6</option>
						  	<option value="7">7</option>
						  	<option value="8">8</option>
						  	<option value="9">9</option>
						  	<option value="10">10</option>
						  	<option value="11" selected>11</option>
					  	<%}%>
					</select>
				</div>
				<br>
				<input type="button" value="Vissza" onclick="closeSettings()">
				<input type="submit" value="Beállítás">
			</form>
		</div>
		<div id="scorePane" class="scorepane" style="display: none;">
			<label >Score:</label>
			<label id="scoreLabel">0</label>
			<label>Record:</label>
			<label id="recordLabel"><%= record%></label>
		</div>
		<br>
		<div id="buttonsPane" style="display: none;">
			<button onclick="gameOver('backToTheMenu')">Menü</button>
			<button onclick="back()">Vissza</button>
			<button onclick="restartGame()">Újrakezdés</button>
			<br>
			<label><h3><u>Lépések</u></h3></label>
			<button onclick="nextStep('bal');">Balra</button>
			<button onclick="nextStep('jobb');">Jobbra</button>
			<button onclick="nextStep('fel');">Fel</button>
			<button onclick="nextStep('le');">Le</button>
		</div>
		<br>
		<div id="myModal" class="modal" style="display: none;">
		  	<div class="modal-content">
		    	<span class="close" onclick="closeGame(); document.getElementById('myModal').style.display = 'none';">&times;</span>
		    	<form action="setdata.jsp" id="gameOverForm">
			    	<label id="gameOverLabel" name="gameOverLabel"></label><br>
			    	<input type="text" id="gameOverName" name="gameOverName" placeholder="Add meg a neved..">
			    	<input type="text" style="display: none;" id="gameOverScore" name="gameOverScore">
			    	<input type="text" style="display: none;" id="gameOverMapsize" name="gameOverMapsize">
			    	<input type="text" style="display: none;" id="gameOverMode" name="gameOverMode">
			    	<input type="text" style="display: none;" id="gameOverLevelReached" name="gameOverLevelReached">
			    	<input type="button" onclick="saveData()" value="Mentés">
		 	 	</form>
		 	 </div>
		</div>
		</center>
	</body>
</html>

<script type="text/javascript">
	var map = [];
	var levelReached = 1;
	var freespaces = [];
	var nullasMezokSzama;
	var om = [];

	function openSettings(){
		document.getElementById("menuPane").style.display = "none";
		document.getElementById("settingsPane").style.display = "block";
	}

	function closeSettings(){
		document.getElementById("menuPane").style.display = "block";
		document.getElementById("settingsPane").style.display = "none";
	}

	function openGame(){
		document.getElementById("menuPane").style.display = "none";
		document.getElementById("scorePane").style.display = "block";
		startGame();
        document.getElementById("buttonsPane").style.display = "block";
	}

	function restartGame(){
		document.getElementById("gameTable").remove();
		startGame();
	}

	function saveData(){
		var gameOverText = document.getElementById("gameOverName").value;
		if(gameOverText.length < 3 || gameOverText.length >30){
			alert("A nevednek 3-30 karaktert kell tartalmaznia!");
		} else {
			document.getElementById("gameOverForm").submit();
		}
	}

	function gameOver(reason){
		document.getElementById("gameOverScore").value = document.getElementById("scoreLabel").textContent;
		document.getElementById("gameOverMode").value = "<%=mode%>";
		document.getElementById("gameOverMapsize").value = "<%=mapsize%>x<%=mapsize%>";
		document.getElementById("gameOverLevelReached").value = levelReached+"";
		document.getElementById("myModal").style.display = "block";
		switch (reason){
            case "win":{
            	document.getElementById('gameOverLabel').innerHTML = "Gratulálunk, nyertél! A pontszámod: "+document.getElementById("scoreLabel").textContent+".";
                break;
            }
            case "outOfLevels":{
            	document.getElementById('gameOverLabel').innerHTML = "Sajnáljuk, de elérted a maximum szintet! A pontszámod: "+document.getElementById("scoreLabel").textContent+".";
                break;
            }
            case "outOfTiles":{
            	document.getElementById('gameOverLabel').innerHTML = "Elfogytak a mezők! A pontszámod: "+document.getElementById("scoreLabel").textContent+".";
                break;
            }
            case "backToTheMenu":{
            	document.getElementById('gameOverLabel').innerHTML = "Ne felejtsd el menteni a pontszámodat:"+document.getElementById("scoreLabel").textContent+".";
                break;
            }
            case "restart": {
            	document.getElementById('gameOverLabel').innerHTML = "Mentsd el az eddig elért pontszámodat:"+document.getElementById("scoreLabel").textContent+".";
                break;
            }
        }
	}

	function back(){
		var notSame = 0;
        for (var i = 0; i < <%=mapsize%>; i++) {
	        for (var j = 0; j < <%=mapsize%>; j++) {
	        	if(om[i][j] == map[i][j]){
	        		notSame++;
	        	}
	        }
        }

        if(notSame < (<%=mapsize%>*<%=mapsize%>)){
        	for (var i = 0; i < <%=mapsize%>; i++) {
	        	map[i] = om[i].map(e => e);
        	}
        	display();
        }
	}

	function startGame(){
		document.getElementById("recordLabel").innerHTML ="<%= record%>";
		document.getElementById("scoreLabel").innerHTML = "0";
		var body = document.getElementsByTagName("body")[0];
		var tbl = document.createElement("table");
		tbl.id = "gameTable";
		tbl.style.display = "block";
		tbl.style.border="1px solid black";
		if(<%=mapsize%> == 5){
			tbl.style.width = "525px";
  		} else if(<%=mapsize%> == 6){
  			tbl.style.width = "538px";
  		} else {
  			tbl.style.width = "596px";
  		}
  		var tblBody = document.createElement("tbody");
		for(var i=0;i< <%=mapsize%>;i++){
			var sor = [];
			var row = document.createElement("tr");
			for(var j=0;j<<%=mapsize%>;j++){
				if(<%=mapsize%>==5){
					var cell = document.createElement("td");
					var image = document.createElement("img");
					image.id = i*<%=mapsize%>+j;
					image.src = "images/number0.png";
					image.width = 100;
					image.height = 100;
				} else if(<%=mapsize%>==6){
					var cell = document.createElement("td");
					var image = document.createElement("img");
					image.id = i*<%=mapsize%>+j;
					image.src = "images/number0.png";
					image.width = 85;
					image.height = 85;
				} else {
					var cell = document.createElement("td");
					var image = document.createElement("img");
					image.id = i*<%=mapsize%>+j;
					image.src = "images/number0.png";
					image.width = 70;
					image.height = 70;
				}
				cell.appendChild(image);
      			row.appendChild(cell);
      			sor[j] = 0;
			}
			map[i] = sor;
      		tblBody.appendChild(row);
		}

		tbl.appendChild(tblBody);
	 	body.appendChild(tbl);

        var x=0,y=0,x2=0,y2=0;
        while(x==x2 && y==y2) {
            x = Math.floor(Math.random() * <%=mapsize%>);
            y = Math.floor(Math.random() * <%=mapsize%>);
            x2 = Math.floor(Math.random() * <%=mapsize%>);
            y2 = Math.floor(Math.random() * <%=mapsize%>);
        }
        map[x][y] = 2;
        map[x2][y2] = 2;
        document.getElementById((x*<%=mapsize%>+y)).src = "images\\number2.png";
        document.getElementById((x2*<%=mapsize%>+y2)).src = "images\\number2.png";
	}

	function nextStep(move){
		var notSame = 0;
		nullasMezokSzama=0;
		for(var i=0;i<<%=mapsize%>;i++){
			om[i] = map[i].map(e => e);
		}
		switch (move){
			case "le":{
                //oszlop elejetol a vegeig
                for (var i = 0; i < <%=mapsize%>; i++) {
                    var elements = [];
                    var size = 0;
                    //sor lentrol felfele
                    for (var j = <%=mapsize%> - 1; j >= 0; j--) {
                        //nem nullas mezok megkeresese
                        if (map[j][i] != 0) {
                            elements[size] = map[j][i];
                            map[j][i] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (var j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                            	document.getElementById("scoreLabel").innerHTML = (Number(document.getElementById("scoreLabel").textContent) + elements[j] * 2).toString();
                                if(Number(document.getElementById("scoreLabel").textContent) > <%=record%>) {
                                    document.getElementById("recordLabel").innerHTML = document.getElementById("scoreLabel").textContent;
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,<%=level%>)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    var place = <%=mapsize%> - 1;
                    for (var j = 0; j< elements.length;j++) {
                    	var element = elements[j];
                        if (element != 0) {
                            map[place][i] = element;
                            place--;

                            if(log2(element)>levelReached){
                                levelReached =log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (var j = 0; j < place+1; j++) {
                        nullasMezokSzama++;
                        var t = [];
                        t[0] = j;
                        t[1] = i;
                        freespaces[nullasMezokSzama-1] = t;
                    }
                }
                break;
            }
        	case "fel":{
                //oszlop elejetol a vegeig
                for (var i = 0; i < <%=mapsize%>; i++) {
                    var elements = [];
                    var size = 0;
                    //sor lentrol felfele
                    for (var j = 0; j < <%=mapsize%>; j++) {
                        //nem nullas mezok megkeresese
                        if (map[j][i] != 0) {
                            elements[size] = map[j][i];
                            map[j][i] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (var j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                            	document.getElementById("scoreLabel").innerHTML = (Number(document.getElementById("scoreLabel").textContent) + elements[j] * 2).toString();
                                if(Number(document.getElementById("scoreLabel").textContent) > <%=record%>) {
                                    document.getElementById("recordLabel").innerHTML = document.getElementById("scoreLabel").textContent;
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,<%=level%>)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    var place = 0;
                    for (var j = 0; j< elements.length;j++) {
                    	var element = elements[j];
                        if (element != 0) {
                            map[place][i] = element;
                            place++;

                            if(log2(element)>levelReached){
                                levelReached =log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (var j = place; j < <%=mapsize%>; j++) {
                        nullasMezokSzama++;
                        var t = [];
                        t[0] = j;
                        t[1] = i;
                        freespaces[nullasMezokSzama-1] = t; 
                    }
                }
                break;
            }
            case "jobb":{
                //oszlop elejetol a vegeig
                for (var i = 0; i < <%=mapsize%>; i++) {
                    var elements = [];
                    var size = 0;
                    //sor lentrol felfele
                    for (var j = <%=mapsize%>-1; j >= 0; j--) {
                        //nem nullas mezok megkeresese
                        if (map[i][j] != 0) {
                            elements[size] = map[i][j];
                            map[i][j] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (var j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                            	document.getElementById("scoreLabel").innerHTML = (Number(document.getElementById("scoreLabel").textContent) + elements[j] * 2).toString();
                                if(Number(document.getElementById("scoreLabel").textContent) > <%=record%>) {
                                    document.getElementById("recordLabel").innerHTML = document.getElementById("scoreLabel").textContent;
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,<%=level%>)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    var place = <%=mapsize%>-1;
                    for (var j = 0; j< elements.length;j++) {
                    	var element = elements[j];
                        if (element != 0) {
                            map[i][place] = element;
                            place--;

                            if(log2(element)>levelReached){
                                levelReached =log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (var j = 0; j < place+1; j++) {
                        nullasMezokSzama++;
                        var t = [];
                        t[0] = i;
                        t[1] = j;
                        freespaces[nullasMezokSzama-1] = t; 
                    }
                }
                break;
            }
            case "bal":{
                //oszlop elejetol a vegeig
                for (var i = 0; i < <%=mapsize%>; i++) {
                    var elements = [];
                    var size = 0;
                    //sor lentrol felfele
                    for (var j = 0; j <<%=mapsize%>; j++) {
                        //nem nullas mezok megkeresese
                        if (map[i][j] != 0) {
                            elements[size] = map[i][j];
                            map[i][j] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (var j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                            	document.getElementById("scoreLabel").innerHTML = (Number(document.getElementById("scoreLabel").textContent) + elements[j] * 2).toString();
                                if(Number(document.getElementById("scoreLabel").textContent) > <%=record%>) {
                                    document.getElementById("recordLabel").innerHTML = document.getElementById("scoreLabel").textContent;
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,<%=level%>)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    var place = 0;
                    for (var j = 0; j< elements.length;j++) {
                    	var element = elements[j];
                        if (element != 0) {
                            map[i][place] = element;
                            place++;

                            if(log2(element)>levelReached){
                                levelReached =log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (var j = place; j < <%=mapsize%>; j++) {
                        nullasMezokSzama++;
                        var t = [];
                        t[0] = i;
                        t[1] = j;
                        freespaces[nullasMezokSzama-1] = t; 
                    }
                }
                break;
            }
		}

		if (nullasMezokSzama == 0){
            gameOver("outOfTiles");
        }

        for (var i = 0; i < <%=mapsize%>; i++) {
        	for (var j = 0; j < <%=mapsize%>; j++) {
  	     		if (om[i][j] == map[i][j]) {
   
        			notSame++;
        		}
        	}
        }

        if (notSame < (<%=mapsize%>*<%=mapsize%>)) {
        	generateNumber();
        	display();
        }
	}

	function display(){
		for (var i = 0; i < <%=mapsize%>; i++) {
			for (var j = 0; j < <%=mapsize%>; j++) {
				document.getElementById((i*<%=mapsize%>+j)).src = "images\\<%=mode%>"+map[i][j]+".png";
			}
		}
	}

	function generateNumber(){
        var place = Math.floor(Math.random() * (nullasMezokSzama-1));
        var value = Math.floor(Math.random() * 100);
        if(value<90){
            map[freespaces[place][0]][freespaces[place][1]] = 2;
        } else {
            map[freespaces[place][0]][freespaces[place][1]] = 4;
            if (levelReached == 1) {
                levelReached = 2;
            }
        }
	}

	function log2(number){
        switch (number){
            case 2: return 1;
            case 4: return 2;
            case 8: return 3;
            case 16: return 4;
            case 32: return 5;
            case 64: return 6;
            case 128: return 7;
            case 256: return 8;
            case 512: return 9;
            case 1024: return 10;
            case 2048: return 11;
            case 4096:return 12;
        }
        return 0;
    }
</script>
