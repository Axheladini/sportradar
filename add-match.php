<?php
  require './app/bootstrap.php';
  require 'header.php'; 
  
  use App\Models\FootballMatches as FootballMatches;

  /** Declera and empty array to store error messages into it*/
  $empty_fields = [];
  /**Assign match least from the json file */
  $scoreboard_json = json_decode(file_get_contents("scoreboard.json"));

?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="field">
      <div class="control">
       <input class="input team_name" type="text" placeholder="Home team" name="home_team">
      </div>
      <?php
        /** Validate home team field */
         if(isset($_POST["home_team"]))
         {
            $home_team = $_POST["home_team"];
             
            if(empty($home_team) || is_numeric($home_team))
            {
                array_push($empty_fields,"Home team name field is required, only string accepted!");
            }
         }         
       ?>
   </div>
   <div class="field">
      <div class="control">
       <input class="input team_name" type="text" placeholder="Away team" name="away_team">
      </div>
      <?php 
        /** Validate away team field */
        if(isset($_POST["away_team"]))
        {
           $away_team = $_POST["away_team"];
            
           if(empty($away_team) || is_numeric($away_team))
           {
               array_push($empty_fields,"Away team name field is required, only string accepted!");
           }
        }         
      ?>
   </div>
   <div class="field team_score_field">
      <div class="control">
       <input class="input team_score" type="text" placeholder="0" name="home_team_score">
      </div>
      <?php
        /** Validate home team score field */
        if(isset($_POST["home_team_score"]))
        {
           $home_team_score = $_POST["home_team_score"];
            
           if(!is_numeric($home_team_score))
           {
               array_push($empty_fields,"Home team score field is required, only numeric accepted!");
           }
        }    
       ?>
   </div>
   <div class="field team_score_field">
      <div class="control">
       <input class="input team_score" type="text" placeholder="0" name="away_team_score">
      </div>
      <?php
        /** Validate away team score field */
        if(isset($_POST["away_team_score"]))
        {
           $away_team_score = $_POST["away_team_score"];

           if(!is_numeric($away_team_score)){
               array_push($empty_fields,"Away team score field is required, only numeric accepted!");
           }
        }   
       ?>
    </div>
   <div class="field">
     <div class="control">
      <div class="select match_status">
        <select name="match_status">
         <option value="progress">In Progress</option>
         <option value="finished">Finished</option>
        </select>
      </div>
    </div>
  </div>
  <div class="field">
    <div class="control">
      <button class="button is-primary match_update_btn">Add match</button>
    </div>
  </div>

<?php 

/* Check if POST form is submited */
if (!empty($_POST)): 
    
    /* Show field validation errors if any */
    $error_size = sizeof($empty_fields);
    if($error_size > 0){
       
        echo "<br>";
        /* Loop through errors to show them on */
        foreach ($empty_fields as $value) {
            echo "<span class='field_error_message'>$value </span><br>";
        }
    }
    else
    {
        /* Decleare a match array to be inserted as a new record into the json file! */
        $match = array(
            'home_team' => $_POST["home_team"],
            'away_team' => $_POST["away_team"],
            'home_team_score' => intval($_POST["home_team_score"]),
            'away_team_score' => intval($_POST["away_team_score"]),
            "match_status" => $_POST["match_status"],
            "total_score" => intval($_POST["home_team_score"] + $_POST["away_team_score"])
          );
        
        $matches = new FootballMatches($scoreboard_json);
    
        /* Check if this is the first record */
        if(filesize("scoreboard.json") == 0){
    
            $match['id'] = 1;
            $first_record = array($match);
            /* Add the first match to the scoreboard*/
            $matches->set_scoreboard($first_record);
        
        }else{
           
            /* Attach scoreboard to a variable called $old_records */  
            $old_records = $matches->get_scoreboard();

            $count_matches = count($old_records);
            $match['id'] = $count_matches + 1;
            
            /* Add a new match to the scoreboard */ 
            $matches->add_record_to_scoreboard($match);
            
        }
        
        /* Convert the scoreboard array to json and prepare it for saving */ 
        $json_match = json_encode($matches->get_scoreboard(), JSON_PRETTY_PRINT);

        /* Open the json file called scoreboard.json */ 
        $file = fopen('scoreboard.json','w+') or die("File not found");

        /* Write the json content to the file and check if it was succesfull */  
        if(fwrite($file, $json_match) === FALSE){
            /* When json is not written to the file */
          echo "<p class='error__message'>Cannot write to file ($file)</p>";
        
        }
        else{
          /* When json is successfully written to the file */ 
          echo "<p class='success_message'>New match successfully added to the scoreboard! <a href='/sport-radar'>Back to scoreboard</a></p>";
          //echo "<p class='success_message'>The page will redirect automatically after 5 sec.</p>";
          
    
        }

        fclose($file);exit; 

    }
    

endif;

require 'footer.php'; 

?>

</div>

