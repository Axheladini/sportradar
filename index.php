<?php

require './app/bootstrap.php';
require 'header.php'; 

use App\Models\FootballMatch as FootballMatch;
use App\Models\FootballMatches as FootballMatches;

/* Attach the content of the json file to a variable */ 
$scoreboard_json = json_decode(file_get_contents("scoreboard.json"));

/* Initiate the FootballMatches Class */
$FootballMatches = new FootballMatches($scoreboard_json);

$scoreboard = $FootballMatches->get_scoreboard();


if(gettype($scoreboard) == "NULL")
{
  echo "<p class='error__message'>No matches detected, please add a match</p>";
}
else{

  foreach ($scoreboard as $value) {
    
    if($value->match_status == "progress")
    {

    /* Initiate the Matche Object */
    $FootballMatch = new FootballMatch($value);

    ?>
     <form action="update-match.php" method="post">
      <div class="columns">
         <div class="column is-2 home_team_col"><?php echo "<p>".$FootballMatch->get_home_team_name()."</p>"; ?></div>
         <div class="column is-1 home_team_score"><div class="control"><input class="input ht_score" type="text" placeholder="score" name="home_team_score_input" value="<?php echo $FootballMatch->get_home_team_score(); ?>"></div></div>
         <div class="column is-1 home_team_score"><div class="control"><input class="input at_score" type="text" placeholder="score" name="away_team_score_input" value="<?php echo $FootballMatch->get_away_team_score(); ?>"></div></div>
         <div class="column is-2 away_team_col"><?php echo "<p>".$FootballMatch->get_away_team_name()."</p>"; ?></div>
         <div class="column is-4 match_status">
             <div class="control">
             <div class="select match_status">
              <select name="match_status">
                <option value="progress" <?php if($FootballMatch->get_match_status()=="progress"){echo "selected";} ?>>In Progress</option>
                <option value="finished" <?php if($FootballMatch->get_match_status()=="finished"){echo "selected";} ?>>Finished</option>
              </select>
             </div>
            </div>
         </div>
           <div class="column is-2 match_update_btn"><button class="button is-primary match_update_btn">Update</button></div>
        </div>
        <input class="input ht_score" type="hidden" name="match_id" value="<?php echo $FootballMatch->get_match_id(); ?>">
      </form>
    <?php
    }/** if ends here */
  }/** Foreach ends here */
}/** Else ends here */
?>
<div class="columns">
 <div class="column">
  <a class="button is-primary is-outlined add_match_btn" href="add-match.php">Add a match</a>
</div>
</div>


<?php 

require 'footer.php'; 