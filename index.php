<?php

require './app/bootstrap.php';

//use App\Models\Match as Match;
use App\Models\FootballMatch as FootballMatch;

$footballMatch = new FootballMatch(1,1);


$footballMatch->update_match_score(2, 4);



echo $footballMatch->get_home_team_score();
echo $footballMatch->get_away_team_score();
echo $footballMatch->get_match_status();
//echo $new_match->get_home_team_score();