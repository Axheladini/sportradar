<?php
use App\Models\FootballMatches as FootballMatches;

require './app/bootstrap.php';
require 'header.php';


$scoreboard_json = json_decode(file_get_contents("scoreboard.json"));
$FootballMatches = new FootballMatches($scoreboard_json);

$scoreboard = $FootballMatches->get_scoreboard();

 /* If Update form has been clicked*/
if (!empty($_POST)):
    
    /* Get the form field values*/
    if(isset($_POST["home_team_score_input"])){ $home_team_score = $_POST["home_team_score_input"]; }
    if(isset($_POST["away_team_score_input"])){ $away_team_score = $_POST["away_team_score_input"]; }
    if(isset($_POST["match_status"])){ $match_status = $_POST["match_status"]; }
    if(isset($_POST["match_id"])){ $id = $_POST["match_id"]; }
    
    /* Loop through mataches */
    foreach ($scoreboard as $value) {
        
        if($value->id == $id)
        {   
            /* Update match score function */
            $FootballMatches->update_match_score($home_team_score, $away_team_score, $match_status, $id);
        }
    }


    /* Convert the scoreboard array to json and prepare it for saving */ 
    $json_match = json_encode($FootballMatches->get_scoreboard(), JSON_PRETTY_PRINT);

    /* Open the json file called scoreboard.json */ 
    $file = fopen('scoreboard.json','w+') or die("File not found");

    /* Write the json content to the file and check if it was succesfull */  
    if(fwrite($file, $json_match) === FALSE){
       echo "<p class='error__message'>Cannot write to file ($file)</p>"; 
     }
     else{
       /* When json is written to the file */  
       echo "<p class='success_message'>Match updated successfully! <a href='/'>Back to scoreboard</a></p>";
       echo "<p class='success_message'>The page will redirect automatically after 5 sec.</p>";
 
        
       /* Redirect after 5 seconds to the  */ 
       echo "<script type='text/javascript'>
          (function(){
             setTimeout(function(){
               window.location='/sport-radar';
             },5000); /* 1000 = 1 second*/
          })();
          </script>
          ";
     }

     fclose($file);exit; 

endif;

require 'footer.php'; 
?>