<?php
namespace App\Models;
/** 
*  FootballMatch class for managing a scoreboard
*  
*  Through the class we are able to add the Home and Away scores,
*  team names and update match status and match score
*  
*  @package Scoreboard
*  @author Agon Xheladini <agonxheladini001@gmail.com> 
*  @version 1.0.0 
*/ 
class FootballMatch {
    
    /**   The score of the home team $var Integer */
    protected $home_team_score;
    /**   The score of the away team $var Integer */
    protected $away_team_score;
    /**   The name of the home team $var String */
    private $home_team;
    /**   The name of the away team $var String */
    private $away_team;
    /**   The match status $var String */
    protected $match_status;

    function __construct($home_score, $away_score) {

       $this->update_match_score($home_score, $away_score);
       $this->set_match_status("In Progress");

    }
        
    /**
     * Set the name of the home team 
     *
     * @param  integer $home_team the score for the away team.
     */
    function set_home_team_name($home_team) {

        $this->home_team = $home_team;
    }
    
    /**
     * Set the name of the away team 
     *
     * @param  integer $away_team the score for the away team.
     */
    function set_away_team_name($away_score) {

        $this->away_team = $away_score;
    }


    /**
     * Set match status 
     *
     * @param  string $match_status the score for the away team.
     */
    function set_match_status($match_status) {

        $this->match_status = $match_status;

    }


    /**
     * Get the score of the home team
     *
     * @return integer the score for the home team.
     */
     function get_home_team_score() {

        return $this->home_team_score;
    }

    /**
     * Get the score of the away team
     *
     * @return integer the score for the away team.
     */
    function get_away_team_score() {

        return $this->away_team_score;
    }

    /**
     * Get the score of the away team
     *
     * @return string Get match status.
     */
    function get_match_status() {

        return $this->match_status;
    }


    /**
     * Set the score for the home team
     *
     * @param  integer $home_score the score for the home team.
     * @param  integer $away_score the score for the away team.
     */
    function update_match_score($home_score, $away_score) {

        $this->home_team_score = $home_score;
        $this->away_team_score = $away_score;

    }
}