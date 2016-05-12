<?php


// Klassenliste

// cl_tabs - Tab Menü, Funktionen: inti(), create($tabarray) - erzeugt eigentliche Tabs mit Inhalt, element($uri,$name) - erzeugt tabelement


// Tabs

class cl_tabs {
	
	var $tabelement = array();
	var $tabarray = array();
	var $u; // url
	var $n; // name
	var $tindex; // tab indexnummer
	
	public function init() {
	
	echo  '<link href="../mylib/template1/tabcontent.css" rel="stylesheet" type="text/css" />
	<script src="../mylib/tabcontent.js" type="text/javascript"></script>';

	}

	

	public function create() {
		
	    global $tabarray;
	    
		$tabindex = array();
	
	
		echo '<ul class="tabs" data-persist="true">';

		foreach($tabarray as $tarray) {
			
			
				
			global $u;
			global $n;
			
			$u = $tarray[0];
			$n = $tarray[1];
				
			
	
	
		echo '<li><a href="#';
	
		$r = rand();
	
		$tabindex[] = $r;
		
		echo $r;
		
		echo '">';
		
		echo $n;
		
		echo '</a></li>';
		
		}
		
		echo '</ul>';
		
		echo '<div class="tabcontents">';
		
		global $tindex;
		
		$tindex = 0;
		
		foreach($tabarray as $tar){
			
		
			
			global $u;
			global $n;
			global $tindex;
			
			
			$u = $tar[0];
			$n = $tar[1];	
			
		echo '<div id="';
		
		echo $tabindex[$tindex];
		
		$tindex = $tindex + 1;
		
		echo '">';
		
		
		echo '<object type="text/html" data="';
		
		echo $u;
		
		echo '" width="100%" height="2000px" style="overflow:auto;border:0px ridge blue">
    </object>';
		
		echo '</div>';
		
		
			
		}
		
		echo '</div>';
		
		
	}
			
			

	public function element($uri,$name) {
		
		global $tabelement;
		global $tabarray;
		
		$tabelement[0] = $uri;
		$tabelement[1] = $name;
		
		$tabarray[] = $tabelement;
		
	
		unset($tabelement);
		
	
	
	
	
	}

}  // END class tabs

class streams{
	// funktionen: add, set_active, set_inactive, del, get	
	
	public function add($what) {
		
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
	
	
	$randid = rand(0,1000);
		
	$sql = "INSERT INTO streams (streams,aktiv,randid)
	VALUES ('$what',1)";	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	} // Ende Funktion add
	
	
	
	public function set_active($what) {
		
		
		
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = "UPDATE streams SET aktiv=1 WHERE streams='$what'";	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	}
	
	
	public function set_inactive($what) {
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = "UPDATE streams SET aktiv=0 WHERE streams='$what'";	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	}
	
	public function del($what) {
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = "DELETE FROM streams WHERE randid='$what'";	
	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	}
	
	
	public function get() {
		
		
		
	
	$rows = array();
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = $sql = "SELECT * FROM streams";	
	
	if	($result = mysqli_query($dbcon, $sql)) {
	
	
		while ($row = mysqli_fetch_assoc($result)) {
			
			
		$rows[] = $row;	
			
	
	
		}
		
		
		return $rows;
	
	
	}
	
	
	mysqli_close($dbcon);
	
	
		
		
		
	}

}

class wishes{
	
	//funktionen add, del
	
	public function add($what) {
	
	
		
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
	
	
	date_default_timezone_set("Europe/Berlin");
	$timestamp = time();	
	$datum = date("Y-m-d");	
	
	$randid = rand(0,1000);	
		
	$sql = "INSERT INTO wishes (wish,found,date,randid)
	VALUES ('$what',0,current_date(),$randid)";	
	
	echo $sql;
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	} // Ende Funktion add
		
		
		
	public function del($what) {
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = "DELETE FROM wishes WHERE randid='$what'";	
	
	
	
	
	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	}
	
	
	public function get() {
	
	$rows = array();
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql = $sql = "SELECT * FROM wishes";	
	
	if	($result = mysqli_query($dbcon, $sql)) {
	
	
		while ($row = mysqli_fetch_assoc($result)) {
			
			
		$rows[] = $row;	
			
	
	
		}
		
		
		return $rows;
	
	
	}
	
	
	mysqli_close($dbcon);
	
	}
	
	
}


function heartbeat() {
	
	
		$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql  = "SELECT * FROM `heartbeat` WHERE 1";	
	
	$result = mysqli_query($dbcon, $sql);
	
	
	
		$row = mysqli_fetch_assoc($result);
			
			
		$heartbeat = $row['heartbeat'];	
			

	
		echo mysqli_error($dbcon);

	
			mysqli_close($dbcon);
		
	
	

	
	
	//aktuelle Zeit mit beat vergleichen
	
	#$currtime = strtotime(date("H:i:s"));
	#$heartbeat2 = strtotime($heartbeat);
	
	
	
	$currtime = intval(date("His"));
	
	
	
	$diff = $currtime - $heartbeat;
	

	
	$diff = abs($diff);

	
	//falls Unterschied größer als 1 Minute (= 100)-> error = 1
	
	
	
	if ($diff > 100) {
		
		$error = 1;
	
	}
	
	else
	
	
  	{
  	
  	
  	

	
			// ansonsten -> error = 0
	
	
	$error = 0;
	
  	}
	
	
	
		$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
	
	
		
	$sql = "UPDATE heartbeat SET error='$error'WHERE id=0";	
	
	mysqli_query($dbcon, $sql);
	

	
	
	
	
	
		mysqli_close($dbcon);
	
	
	
	
	
	
	
	
		$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
		
	$sql  = "SELECT * FROM `heartbeat` WHERE 1";	
	
	$result = mysqli_query($dbcon, $sql);
	
	
	
		$row = mysqli_fetch_assoc($result);
			
			
		$heartbeat = $row['error'];	
			

	
		echo mysqli_error($dbcon);
	
		mysqli_close($dbcon);
	
		
		if ($heartbeat == 1) {
			
		echo "</br> FEHLER: Keine Verbindung zum StreamWriter. Offenbar läuft das Skript zur Zeit nicht. Die Funktionen zum Starten und Stoppen von Aufnahmen stehen nicht zur Verfügung. Aufträge zum Hinzufügen / Entfernen von Streams / Wünschen werden beim nächsten Kontakt zum Skript abgearbeitet. </br>";	
			
			
		}
}


class songs{

	public function getall() {
	
	
	
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
	
	
	$sql  = "SELECT * FROM `newsongs` ORDER BY streamname DESC";	
	$result = mysqli_query($dbcon, $sql);
	
		while ($row = mysqli_fetch_assoc($result)) {
			
		$myrow["streamname"] = $row["streamname"];
		$myrow["file"] = $row["file"];
		
		$rows[] = $myrow;	
	
	
		}
		
	
	
	
	
	mysqli_close($dbcon);
	
	return $rows;
	
	
	}
	
	

				
	public function del($what) {
		
	//datei löschen
	
	
	
	
	
	
	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_streamrecorder");
	

	
	$sql  = "SELECT * FROM `newsongs` WHERE streamname='$what'";	
	
	$result = mysqli_query($dbcon, $sql);
	
		while ($row = mysqli_fetch_assoc($result)) {
			
		$myrow["streamname"] = $row["streamname"];
		$myrow["file"] = $row["file"];
		
		
	
	
		}
		
		
       unlink($myrow["file"]);	
	
	
	
	// aus DB löschen
	
		
	$sql = "DELETE FROM newsongs WHERE streamname='$what'";	
	$result = mysqli_query($dbcon, $sql);
	
	
	
	
	
	mysqli_query($dbcon, $sql);
	
	mysqli_close($dbcon);
	
	}
		
		
		
		

	
	
}

class ampache{
	
 public function autodel() {
 	
 	
 // nach Rating 1 suchen und wenn gefunden entsprechende datei löschen...tabelle rating
 // benötigt wird die object_id
 
 	
	$servername = "localhost";
	$username = "freddyss_stream";
	$password = "StRE1!M";

	// Create connection
	$dbcon = mysqli_connect($servername, $username, $password);
	mysqli_select_db($dbcon,"freddyss_ampa465");
 
 	$sql  = "SELECT * FROM `rating` WHERE rating=1";	
	
	$result = mysqli_query($dbcon, $sql);
	
		while ($row = mysqli_fetch_assoc($result)) {
			
		$objectid = $row["object_id"];
		
		$sql  = "SELECT * FROM `song` WHERE id=$objectid";
		
		$result2 = mysqli_query($dbcon, $sql);
		
			while ($row = mysqli_fetch_assoc($result)) {
		
			$file = $row["file"];
		
			$file = str_replace("/home/freddyss/public_html/","",$file);
			
			$delfile = "../../../".$file;
			
			unset($delfile);
		
			}
	
	
		}
		
 
 
 
 
 		

	
    mysqli_close($dbcon);
 	
 	
 	
 	
 	
 }	
	
	
	
}

?>