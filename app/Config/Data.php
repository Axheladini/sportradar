<?php
namespace App\Config;

class Data {
   
    protected $ships = array();
    private $top_speed;

    function __construct($ships) {
        
        //Convert Json to array
        $data = json_decode($ships,TRUE);
        
        //Sort Array in DESC Order
        $finaldata = $data["results"];
        $keys = array_column($finaldata, 'max_atmosphering_speed');
        array_multisort($keys, SORT_DESC, $finaldata);
        
        //Assign array to ships 
        $this->ships = $finaldata;
        
        //Find Highest Speed
        $this->FindTopSpeed($finaldata);

    }

    public function FindTopSpeed($array){
        
        //Loop to find the highest speed
        $max = 0;

        foreach($array as $sub_array) {
          
            if(is_numeric($sub_array['max_atmosphering_speed']))
            {
                if($sub_array['max_atmosphering_speed'] > $max)
                {
                    $max = $sub_array['max_atmosphering_speed'];
                }
            }
        }

        $this->top_speed = $max;
    }

    public function getTopSpeed(){
        return $this->top_speed;
    }

    public function getShips(){
        return $this->ships;
    }

}