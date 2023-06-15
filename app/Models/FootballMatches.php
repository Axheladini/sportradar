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

    private $scoreboard = [];

    function __construct($scoreboard_array) {

        $this->$scoreboard = $scoreboard_array;
     
     }

     function set_scoreboard($scoreboard_array){
        $this->$scoreboard = $scoreboard_array;
     }

}




?>