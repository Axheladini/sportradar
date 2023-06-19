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
      /** Assign the array from the file to the class Array*/
      $this->ArrayScoreboard = $scoreboardArray;
      /** If it is an Array sort it based on the method*/
      if(is_array($scoreboardArray)){ $this->sort_scoreboard_by_goals();}
      
    }

    /**
    * Set the scoreboard array 
    *
    * @param array $scoreboard_array.
    */
    function set_scoreboard($scoreboard_array){
      $this->ArrayScoreboard = $scoreboard_array; 
    }
    
    /**
    * Get scoreboard
    *
    * @return array the scoreboard list.
    */
    function get_scoreboard(){
      return $this->ArrayScoreboard;
    }
    
    /**
    * Add a new single record to the scoreboard array 
    *
    * @return array $record.
    */
    function add_record_to_scoreboard($record){
      array_push($this->ArrayScoreboard, $record);
    }
   
    /**
    * Update match score and status 
    *
    * @return array updates $record.
    */
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
   /**
    * Sort the scoreboard in DESC order. 
    *
    * @return array sorted scoreboard.
    */
   function sort_scoreboard_by_goals(){
      
      $col = array_column( $this->ArrayScoreboard, "total_score" );
      array_multisort( $col, SORT_DESC, $this->ArrayScoreboard );

   }

}

?>