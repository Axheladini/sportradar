<?php
namespace App\Swapi;

class Ships {
   
    private $name;
    private $model;
    private $cargo;
    private $capacity;
    private $crew_size;
    private $slower_than_fastest_one;

    private $pilots = array();

    function __construct($ship, $topSpeed) {

        $this->setName($ship["name"]);
        $this->setModel($ship["model"]);
        $this->setCargo($ship["cargo_capacity"]);
        $this->setCapacity($ship["passengers"]);
        $this->setCrewSize($ship["crew"]);
        $this->setPilots($ship["pilots"]);
        
    }

    /*public function to set Ship name */
    public function setName($name){
        $this->name = $name;  
    }

    /*Public function to set Ship model*/
    public function setModel($model){
        $this->model = $model;
    }
    
    /*Public function to set Ship Cargo*/
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    /*Public function to set Ship Capacity*/
    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }

    /*Public function to set Ship Crew*/
    public function setCrewSize($crew_size){
        $this->crew_size = $crew_size;
    }

    /*Public function to set Ship Crew*/
    public function setPilots($pilots){
        $this->pilots = $pilots;
    }

    /*Public function to get name*/
    public function getName(){
        return $this->name;
    }

    /*Public function to get model*/
    public function getModel(){
        return $this->model;
    }

    /*Public function to get cargo*/
    public function getCargo(){
        return $this->cargo;
    }

     /*Public function to get capacity*/
    public function getCapacity(){
        return $this->capacity;
    }

    /*Public function to get capacity*/
    public function getCrewSize(){
        return $this->crew_size;
    }

    /*Public function to set Ship Crew*/
    public function getPilots(){
        return $this->pilots;
    }

    /*Public function to calculate the speed of a ship*/
    public function slowerThanFastesOne($shipSpeed, $fastesSpeed){
        if(is_numeric($shipSpeed))
        {
            $diference = intval($fastesSpeed)-intval($shipSpeed);
            $percentage = ($diference / $fastesSpeed) * 100;
            return $percentage."%";
        }
        else{
            return $shipSpeed;
        }
        
    }

    /*Public function to reduce Cargo Capacity*/
    public function reduceCargoCapaity($new_capacity){
        return $this->cargo = $new_capacity;
    }

}