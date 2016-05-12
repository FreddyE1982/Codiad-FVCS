<?php
    // For config related stuff, we need to include the common.php
    require_once('../../common.php');  
    include "../../workspace/drafts/fvcs/version.php";
    // also we check for authenitification
    checkSession();
    
    if(isset($_GET["path"])) {
    
    $path = $_GET["path"];
    
    }
    

    // let as switch between our different actions if we want to display different dialogs
    switch($_GET['action']){
    
    
    
    // aktuelle versionsnummer feststellen
    
    	
   
    
       
    
        case 'save':
                	          
            	       
            echo "
                   
            Path: $path </br>
            You can save your changes to the current version or create a new version.</br></br>
            ";
            
           echo '<button class="btn-right" onclick="window.location.href=';
            
            
           echo  "'http://www.freddysserver.com/codiad/workspace/drafts/fvcs/codiad.php?action=save&path=$path'";
           
           echo '">';
           
            ?>
           
                 
            
            
            <?php i18n("Save to new version"); ?></button>
            <button class="btn-right" onclick="codiad.modal.unload(); return false;"><?php i18n("Save to current version"); ?></button> <?
           
            
            
            break; 
            
         case 'open':
         
         
         
         
         break;
            
            
                      
    }   
?>