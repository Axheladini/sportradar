<?php
namespace App\Models;
/** 
*  Matches for
*  
*  Through this class we are able keep the scoreboard in array and work with the array!
*  
*  @package Scoreboard array/list managin
*  @author Agon Xheladini <agonxheladini001@gmail.com> 
*  @version 1.0.0 
*/ 

class FootballMatches {
    

    /** Array variable to hold the scoreboard array*/
    protected $ArrayScoreboard = [];

    function __construct($scoreboardArray){
      $this->ArrayScoreboard = $scoreboardArray;
      if(is_array($scoreboardArray)){
         $this->sort_scoreboard_by_goals();
      }
      
    }

    function set_scoreboard($scoreboard_array){
      $this->ArrayScoreboard = $scoreboard_array; 
   }

    function get_scoreboard(){
      return $this->ArrayScoreboard;
    }

    function add_record_to_scoreboard($record){
      array_push($this->ArrayScoreboard, $record);
    }

    function update_match_score($home_team_score, $away_team_score, $status, $id){
      
      foreach ($this->ArrayScoreboard as $value) {
         
         if($value->id == $id)
         {  
            $value->home_team_score = intval($home_team_score);
            $value->away_team_score = intval($away_team_score);
            $value->match_status = $status;
            $value->id = intval($id); 
            $value->total_score = intval($home_team_score) + intval($away_team_score);
         }
         
       }
    }

   function sort_scoreboard_by_goals(){
      
      $col = array_column( $this->ArrayScoreboard, "total_score" );
      array_multisort( $col, SORT_DESC, $this->ArrayScoreboard );
   }

}




?>