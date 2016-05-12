<?php
//fff



class versions {
	
	var $dbcon = "";
	var $path = "";
	
	public $fetchoutput;
	
	public function dbcon() {
		
		$servername = "localhost";
		$username = "freddyss_stream";
		$password = "StRE1!M";

		// Create connection
		$mydbcon = mysqli_connect($servername, $username, $password);
		mysqli_select_db($mydbcon,"freddyss_streamrecorder");
		
		$this->dbcon = $mydbcon;
		
		
		
		
	}
	
	

	public function dbclose() {
		
		mysqli_close($this->dbcon);
		
	}
	
	public function dbquery($query) {
		
	$result = mysqli_query($this->dbcon, $query);
	
	return $result;
		
	}	
	
	
	public function dbfetch($query) {
		
		$result = mysqli_query($this->dbcon, $query);
	//	echo var_dump($result);	
	//	echo mysqli_error($this->dbcon);
		
		//echo $query;
		
		if	($result = mysqli_query($this->dbcon, $query))	 {
				
			
				
	
	
			while ($row = mysqli_fetch_assoc($result)) {
			
			
			$rows[] = $row;	
			
	
	
			}
		
		
			
			$this->fetchoutput = $rows;
			
			return $rows;
	
		
			}
			
		else {
				
			$this->fetchoutput = false;
				
				
			}
		
		
	}
	
	public function path() {
		
	if (strpos($path,"/")) {
		
		
		$path = str_replace("/","-",$path);
		
		//return $path;
		
	}
		
		if (strpos($path,"-")) {
		
		
		$path = str_replace("-","/",$path);
		
		//return $path;
		
	}
			
		
		
		
	}

	
	public function file_register($name,$fullpath) {
	
	$this->dbcon();
	
	$path = $fullpath;
	
	$this->path($fullpath);
	
	$fullpath = $path;
	
	
	if (!$this->dbfetch("SELECT * FROM RealNames WHERE name='$name' AND fullpath='$fullpath'")) {
		
	
	
	
	
	
	$this->dbquery("INSERT INTO RealNames VALUES (NULL,'$name','$fullpath','1')");
	
	// als erste version registrieren
	
	$this->dbclose();
		
		
	}
		
	}
	
	
	public function splitPath($path) {
		
	$explode = explode("/",$path);
		
	 $filename = end($explode);
	 
	 
	 

	 
	 $stop = strripos ($path,"/");
	 
	 $length = $stop + 1; ///////////////////
	 
	 $path = substr ($path ,  0 ,$length);
	 
	 $fileinfo["path"] = $path;
	 
	 $fileinfo["filename"] = $filename;
	 
	 return $fileinfo;
	 
		
	}
	
	
	public function getV($name,$fullpath) {
		
		
		
		
		
		
		
	}
	
	public function isNewFile($name,$fullpath){
		
	$this->dbcon();
	
		if (!$this->dbfetch("SELECT * FROM RealNames WHERE name='$name' AND fullpath='$fullpath'")) {
		
			$this->file_register($name,$fullpath);
			
			$this->register($name,$fullpath);
			
			
			return true;
			
		
		
		}
		
		
		else {
			
			return false;
			
		}
	
	
	
	$this->dbclose();
		
		
	}

	public function register($name,$fullpath) {
		
	$this->dbcon();
	
	
	$rows = $this->dbfetch("SELECT ID FROM RealNames WHERE name='$name' AND fullpath='$fullpath'");
	
	$row = $rows[0];
	
	$ID = $row["ID"];
	
	
	if (!$this->dbfetch("SELECT * FROM versions WHERE realid=$ID")) {
		
	 $V = 1;	
		
	$filenr = rand(0,9999999999);
	
	//prüfen ob es schon ne datei mit dieser nummer gibt, wenn ja dann wiederholen bis nicht
	
	while ($this->dbfetch("SELECT * FROM versions WHERE filenr='$filenr'")) {
	
		$filenr = rand(0,9999999999);
		
	}
	
	 
	 $datum =  date("j.n.Y. G:i:s");
	 

	 
	 
	 $this->dbquery("INSERT INTO versions VALUES ($ID,$V,'$filenr','$datum')");
	 
	 
	 copy("$fullpath"."$name","vs/".$filenr);
	 
		
	}
	
	
	else {
		
		
	
		
	 $rows = $this->dbfetch("SELECT MAX(version) as version FROM versions WHERE realid=$ID");
	 
	 $row = $rows[0];
	 
	 $V = $row["version"];
	 
	 $V = $V + 1;
	 
	 $filenr = rand(0,9999999999);
	 
	 
	 //prüfen ob es schon ne datei mit dieser nummer gibt, wenn ja dann wiederholen bis nicht
	 
	 while ($this->dbfetch("SELECT * FROM versions WHERE filenr='$filenr'")) {
	
		$filenr = rand(0,9999999999);
		
	}
	 
	 
	 
	 
	 $datum = date("j.n.Y. G:i:s");
	 
	 $this->dbquery("INSERT INTO versions VALUES ($ID,$V,'$filenr','$datum')");
	 $this->dbquery("UPDATE RealNames SET versioncount=$V WHERE ID=$ID");
	 
	 
	 copy("$fullpath"."$name","vs/".$filenr);
	 
	 
	 
	 
		
	}
	
	
	$this->dbclose();
	
		
		
	}
	
	public function get($fullpath, $version, $name) {
		
	$this->dbcon();
	
	
	
	if ($this->dbfetch("SELECT * FROM RealNames WHERE (SELECT ID from RealNames WHERE fullpath='$fullpath' AND name='$name')")){
	
		
	$rows = $this->dbfetch("SELECT * FROM RealNames WHERE (SELECT ID from RealNames WHERE fullpath='$fullpath' AND name='$name')");
	
	$row = $rows[0];
	
	$filenr = $row["filenr"];
	
	$crdate = $row["crdate"];
	
	
	$arr_result["filenr"] = $row["filenr"];
	
	$arr_result["crdate"] = $row["crdate"];
	
	return $arr_result;
	
	
	
	}
	
	else {
		
		
	return false;
		
		
		
		
	}
	
	
	$this->dbclose();
		
	
	}
	
	public function rollback($fullpath,$version,$name) {
		
	$this->dbcon();	
		
		if ($get = $this->get($fullpath,$version)) {
	
		$filenr = $get["filenr"];
	

	
			if (copy($filenr,$fullpath.$name)) {
				
				return true;

			}
			
			else {
				
				return false;
				
			}
	
	
	
		}
	
		else {
		
		return false;
		
		}
		
		
		
		
		
	$this->dbclose();	
	}
	
	public function dolist_versions($fullpath,$name) {
	
	$this->dbcon();
	
		$this->dbfetch("SELECT * FROM RealNames WHERE fullpath='$fullpath' AND name='$name'");
		
		
	
		if ($rows = $this->fetchoutput) {
		
		$realname = $rows[0];
		
		$id = $realname["ID"];
		
		$this->dbfetch("SELECT * FROM versions WHERE realid='$id'");
		
		
		
		}
		
		else {
			
			
			$this->fetchoutput = false;
			
			
		}
		
		
	
		
	$this->dbclose();	
	}
	
	public function dolist_RealNames() {
		
	$this->dbcon();
	
	$this->dbfetch("SELECT name,fullpath,versioncount FROM RealNames");
	
	$this->dbclose();
	
		
		
		
		
	}
	
	
	
	
	public function maketable($dataarray,$fieldname,$table_id,$actiondetails = "NA") {
		
	echo "<script>
$(document).ready( function () {

    $('#$table_id').DataTable();
    $('.clickable-row').click(function() {
        window.document.location = $(this).data('href');
    });


} );</script>";	
		
	$this->dbcon();
		
		$this->dbfetch("SELECT `COLUMN_NAME` 
	FROM `INFORMATION_SCHEMA`.`COLUMNS` 
	WHERE `TABLE_SCHEMA`='freddyss_streamrecorder' 
	AND `TABLE_NAME`='$table_id' LIMIT 1");
	
	$datacolumnames = $this->fetchoutput;
	
	$this->dbclose();	
		
	
		
		
	echo "<table id='$table_id' class='display'>
    <thead>
        <tr>";	
		
		foreach($fieldname as $key) {
    
		$data_field_names[] = $key;		
			
		}
		
		
		
	
	
	
		foreach ($data_field_names as $name){
			
		echo "<th>$name</th>";	
		
		}
		
        echo "</tr>
        </thead>
        <tbody>";
        
        
        	$fieldcount = count($fieldname);
				
			$fcountinit = $fieldcount;	
				
					
					
						
						
        
        
		foreach ($dataarray as $datarow) {
		
			if ($actiondetails != "NA") {	
			echo "<tr class='clickable-row' data-href='http://www.freddysserver.com/codiad/workspace/drafts/fvcs/codiad.php?$actiondetails'>"; // Entsprechende REALID vorher noch ermitteln und hier mit var $RID einfügen
			}
			
			else {
			echo "<tr>";
	
			}
			
			
			foreach ($datarow as $data) {
				
			
						if ($fieldcount !== 0) {			
						
						//echo "</br> Data: $data";
						
						echo "<td>$data</td>";    
						
						$fieldcount = $fieldcount - 1;
				
						}
						
						
				  
					
					
					
					}
			
		
			echo "</tr>";
			
			$fieldcount = $fcountinit;
				
			}
			
			
				
			
			
			echo "</tbody>
	</table>";		
		
		}
	
	

		
		

	
	
	public function delold($realid, $name,$fullpath,$cutoff) {
		
	//"j.n.y.-G:i:s"	
	
	$this->dbcon();
	
		if ($vlist = $this->dolist($fullpath,$name)) {
		
			foreach ($vlist as $vinfo) {
			
				if ($vinfo["realid"] = $realid) {
					
					// datum handeln und vergleichen
					
				//	"j.n.Y. G:i:s"
					
				$cutoff = date_create_from_format("j.n.Y. G:i:s",$cutoff);
				
				$crdate = date_create_from_format("j.n.Y. G:i:s",$vinfo["crdat"]);
				
			
					if ($crdat < $cutoff) {
				
					
						$filenr = $vinfo["filenr"];
					
						if (unlink("vs/$filenr")) {
						
							$this->dbquery("DELETE FROM versions WHERE filenr = '$filenr'");
							
							// wenn keine weiteren datensätze mit dieser realid existieren, entsprechenden satz in RealNames löschen
							
							if(!$this->dbfetch("SELECT * from versions WHERE realid=$realid")) {
								
								
								$this->dbquery("DELETE FROM RealNames WHERE ID = '$realid'");
								
								
							}
							
							
						
						
						}	
					
					}
					
					
				}
			
			
			}
		
		
		}
	
	
	
	
	
	
	
	$this->dbclose();	
	
	}
	
	public function clean_realnames() {
		
		
	}
	
}
























?>