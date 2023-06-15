<?php

require './app/bootstrap.php';

//use App\Models\Match as Match;
use App\Models\FootballMatch as FootballMatch;

$footballMatch = new FootballMatch(0,0);

$footballMatch->set_home_team_name("Juventus");
$footballMatch->set_away_team_name("Fiorentina");
$footballMatch->set_match_status("In Progress");
$footballMatch->update_match_score(2, 4);

$json_match = json_encode($footballMatch);

$get_current = file_get_contents("scoreboard.json");

$temp_array = [];

array_push($temp_array, $get_current);

$match = '{"home-team":"Juventus", "away-team":"Fiorentina", "home-score":2, "away-score":1, "match-status":"In Progress"}';

array_push($temp_array, $match);

print_r($temp_array);

$json_match = json_encode(json_decode($temp_array));

$file = fopen('scoreboard.json','w+') or die("File not found");
fwrite($file, $json_match);
fclose($file);exit; 