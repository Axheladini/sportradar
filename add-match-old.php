<?php
  require './app/bootstrap.php';
  require 'header.php'; 
  
  use App\Models\FootballMatch as FootballMatch;
  use App\Models\FootballMatches as FootballMatches;

  $empty_fields = [];

?>

<div class="container form_holder">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   <div class="field">
    <!-- <label class="label">Home team</label> -->
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
    <!-- <label class="label">Away team</label> -->
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
    <!-- <label class="label">Home team score</label> -->
      <div class="control">
       <input class="input team_score" type="text" placeholder="ht score" name="home_team_score">
      </div>
      <?php
        /** Validate home team score field */
        if(isset($_POST["home_team_score"]))
        {
           $home_team_score = $_POST["home_team_score"];
            
           if(empty($home_team_score) || !is_numeric($home_team_score))
           {
               array_push($empty_fields,"Home team score field is required, only numeric accepted!");
           }
        }    
       ?>
   </div>
   <div class="field team_score_field">
   <!-- <label class="label">Away team score</label> -->
      <div class="control">
       <input class="input team_score" type="text" placeholder="at score" name="away_team_score">
      </div>
      <?php
        /** Validate away team score field */
        if(isset($_POST["away_team_score"]))
        {
           $away_team_score = $_POST["away_team_score"];
            
           if(empty($away_team_score) || !is_numeric($away_team_score))
           {
               array_push($empty_fields,"Away team score field is required, only numeric accepted!");
           }
        }   

       ?>
    </div>
   <div class="field">
    <!-- <label class="label">Match status</label> -->
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
      <button class="button is-link">Save</button>
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
       
        $match = array(
            'home_team' => $_POST["home_team"],
            'away_team' => $_POST["away_team"],
            'home_team_score' => $_POST["home_team_score"],
            'away_team_score' => $_POST["away_team_score"],
            "match-status" => "In Progress"
          );

        $Matches = new FootballMatches("Juventus","Fiorentina",0,0);
        
        /* Check if this is the first record */
        if(filesize("scoreboard.json") == 0){
    
            $match['id'] = 1;
            $first_record = array($match);
            $data_to_save = $first_record;
        
        }else{
           
            $old_records = json_decode(file_get_contents("scoreboard.json"));
            $count_matches = count($old_records);
            $match['id'] = $count_matches + 1;
            array_push($old_records, $match);
            $data_to_save = $old_records;
        }
        
        $json_match = json_encode($data_to_save, JSON_PRETTY_PRINT);

        $file = fopen('scoreboard.json','w+') or die("File not found");
        fwrite($file, $json_match);
        fclose($file);exit; 

    }
    

endif;

require 'footer.php'; 

?>

</div>

