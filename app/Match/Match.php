<?php
namespace App\Models;


class Match {

    private $home_team;
    private $away_team;
    protected $home_team_score;
    protected $away_team_score;
    protected $match_status;

    function __construct($home_score, $away_score) {

       $this->set_home_team_score($home_score);
       $this->set_away_team_score($away_score);
       
    }
    
    /**
     * Set the score for the home team
     *
     * @param  integer $home_score the score for the home team.
     */

    function set_home_team_score($home_score) {

        $this->home_team_score = $home_score;
    }

    /**
     * Set the score for the away team
     *
     * @param  integer $away_score the score for the away team.
     */
    function set_away_team_score($away_score) {

        $this->away_team_score = $away_score;
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

}