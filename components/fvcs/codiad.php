<?

include "version.php";

$VCS = new versions();


$action = $_GET["action"];


switch ($action) {
	
	
	case "save":
	
	$codiadpath = $_GET["path"];
	

	$base_path = "/home/freddyss/public_html/codiad/workspace/";
	
	$path = $base_path.$codiadpath;
	
	
	 //split of the filename
    
    $fileinfo = $VCS->splitPath($path);
    
    
    
    $fullpath = $fileinfo["path"];
    
    $name = $fileinfo["filename"];
    
    // is this a new file
   		
   		if(!$VCS->isNewFile($name,$fullpath)) {
   		
	   		$VCS->register($name,$fullpath);
   		
   		
   		}
   		
   	header("location: http://www.freddysserver.com/codiad/");
   	
    
    
    
	
	
	break;
	
	
	
	
	
	
	
}












?>