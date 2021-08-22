 function meccsKiir(str) {
	  var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	response = this.responseText.split(",");
	    	document.getElementById("hazaicsapat").innerHTML = "Hazai csapat: "+ response[0];
	    	document.getElementById("vendegcsapat").innerHTML = "Vendég csapat:  " + response[1];
	    	document.getElementById("eredmeny").innerHTML = "Eredmény: " + response[2];
	    	document.getElementById("fordulo").innerHTML = "Forduló: " + response[3];
	    }
	  };
	  xhttp.open("GET", "getMeccsData.php?q="+str, true);
	  xhttp.send();
	}

	function jatekosKiir(str) {
	  var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	response = this.responseText.split(",");
	    	document.getElementById("jatekosneve").innerHTML = "Játékos neve: "+ response[0];
	    	document.getElementById("jatekoscsapata").innerHTML = "Játékos csapata:  " + response[1];
	    	document.getElementById("jatekosposztja").innerHTML = "Játékos posztja: " + response[2];
	    }
	  };
	  xhttp.open("GET", "getJatekosData.php?q="+str, true);
	  xhttp.send();
	}

	function jatekosTorles(){
		var selectBox = document.getElementById("idjatekos");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;	
		var xhttp;
	 	xhttp = new XMLHttpRequest();
	 	xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	alert("Sikeresen töröltük a játékost!");
		    }
	 	};
	  	xhttp.open("GET", "deleteJatekos.php?q="+selectedValue, true);
	  	xhttp.send();
	  	location.reload();
	}	

	function meccsTorles(){
		var selectBox = document.getElementById("idmeccs");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;	
		var xhttp;
	 	xhttp = new XMLHttpRequest();
	 	xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	alert("Sikeresen töröltük a meccset!");
		    }
	 	};
	  	xhttp.open("GET", "deleteMeccs.php?q="+selectedValue, true);
	  	xhttp.send();
		location.reload();
	}

	function jatekosKiir1(str) {
	  var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	response = this.responseText.split(",");
	    	document.getElementById("jatekosnevecs").value = response[0];
	    	document.getElementById(response[1]+"").selected = true;
	    	document.getElementById(response[2]+"").selected = true;
	    }
	  };
	  xhttp.open("GET", "getJatekosData.php?q="+str, true);
	  xhttp.send();
	}

	function meccsKiir1(str) {
	  var xhttp;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	response = this.responseText.split(",");
	    	er = response[2].split("-");
	    	document.getElementById(response[0]+"1").selected = true;
	    	document.getElementById(response[1]+"2").selected = true;
	    	document.getElementById("hgolc").value = parseInt(er[0]);
	    	document.getElementById("vgolc").value = parseInt(er[1]);
	    	document.getElementById("forc").value = parseInt(response[3]);
	    }
	  };
	  xhttp.open("GET", "getMeccsData.php?q="+str, true);
	  xhttp.send();
	}

	function kuldes(csapat){
		switch(csapat){
			case "Ferencvárosi": document.Ferencvárosi.submit(); break;
			case "Kisvárda": document.Kisvárda.submit(); break;
			case "MOL": document.MOL.submit(); break;
			case "Paks": document.Paks.submit(); break;
			case "Puskás": document.Puskás.submit(); break;
			case "Budafok": document.Budafok.submit(); break;
			case "Zalaegerszeg": document.Zalaegerszeg.submit(); break;
			case "Diósgyőri": document.Diósgyőri.submit(); break;
			case "Újpest": document.Újpest.submit(); break;
			case "Honvéd": document.Honvéd.submit(); break;
			case "Mezőkövesd": document.Mezőkövesd.submit(); break;
			case "MTK": document.MTK.submit(); break;
		}
	}