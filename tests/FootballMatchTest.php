<?php
namespace App\Models;
use PHPUnit\Framework\TestCase;

final class FootballMatchTest extends TestCase
{
    /** Public variable for stdClass*/
    public $match_data;
     
    /**
     * Function to construct the Football match Object
     *
     * @return object football match data
     */
    public function constructObject()
    {      
           $this->match_data = new \stdClass();
           $this->match_data->home_team = "Juventus";
           $this->match_data->away_team = "Bologna";
           $this->match_data->home_team_score = intval(3);
           $this->match_data->away_team_score = intval(2);
           $this->match_data->match_status = "progress";
           $this->match_data->total_score = intval(5);
           $this->match_data->id = intval(25);

           return $this->match_data;
    }
    
    /**
     * Function to test home team name, method get_home_team_name()
     */
    public function testHomeTeamName()
    {
         
         $match = $this->constructObject();
         $FootballMatch = new FootballMatch($match);
         
         $home_team = $FootballMatch->get_home_team_name();
         $this->assertSame($home_team , "Juventus");
    }

    /**
     * Function to test Match status, method get_match_status()
     */
    public function testMatchStatus()
    {
         
         $match = $this->constructObject();
         $FootballMatch = new FootballMatch($match);
         
         $match_status = $FootballMatch->get_match_status();

         $this->assertIsString($match_status);
         $this->assertSame($match_status , "progress");
    }
    /**
     * Function to test Total Score, method get_match_total_score()
     */
    public function testTotalScore()
    {
         
         $match = $this->constructObject();
         $FootballMatch = new FootballMatch($match);
         
         $total_score = $FootballMatch->get_match_total_score();
         
         $this->assertEquals($total_score, 5);
         $this->assertIsInt($total_score);
    }
    /**
     * Function to test score update, method update_match_score()
     */
    public function testScoreUpdate()
    {
         
         $match = $this->constructObject();
         $FootballMatch = new FootballMatch($match);
         
         $update_score = $FootballMatch->update_match_score(4,3);
         $home_team_score = $FootballMatch->get_home_team_score();
         $away_team_score = $FootballMatch->get_away_team_score();
         
         $this->assertEquals($home_team_score, 4);
         $this->assertEquals($away_team_score, 3);
         $this->assertIsInt($home_team_score);
         $this->assertIsInt($away_team_score);
    }
     /**
     * Function to test match_id, method get_match_id()
     */
    public function testMatchId()
    {
         
         $match = $this->constructObject();
         $FootballMatch = new FootballMatch($match);
         
         $match_id = $FootballMatch->get_match_id();
         
         $this->assertSame($match_id , 25);
         $this->assertIsInt($match_id);
    }
}