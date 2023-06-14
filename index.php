<?php

require './app/bootstrap.php';

use App\Config\Data as Data;
use App\Swapi\Ships as Ships;
use Widop\HttpAdapter\CurlHttpAdapter as CurlHttpAdapter;

$httpAdapter = new CurlHttpAdapter();

$response = $httpAdapter->getContent('https://swapi.dev/api/starships');
$result = $response->getBody();

$DataShips = new Data($result); 
$arrayShips = $DataShips->getShips();
$topSpeed = $DataShips->getTopSpeed();

echo "<table>";

echo "<tr style='border-bottom: 1px solid #ccc;'>";
echo "<th style='border-bottom: 1px solid #ccc;'>Name</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>Model</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>Cargo capacity</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>Passengers</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>crew</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>slower than fastest one</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>Reduced cargo</th>";
echo "<th style='border-bottom: 1px solid #ccc;'>Pilots</th>";
echo "</tr>";

  foreach($arrayShips as $ship) {
   
        $ShipObj = new Ships($ship, $topSpeed);


        echo "<tr style='border-bottom: 1px solid #ccc;'>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->getName()."</td>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->getModel()."</td>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->getCargo()."</td>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->getCapacity()."</td>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->getCrewSize()."</td>";
        echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->slowerThanFastesOne($ship['max_atmosphering_speed'], $topSpeed)."</td>";
        
        if($ShipObj->getName() == "Millennium Falcon"){
            $newCargo = 50000;
            echo "<td style='border-bottom: 1px solid #ccc;'>".$ShipObj->reduceCargoCapaity($newCargo)."</td>";
        }
        else{
            echo "<td style='border-bottom: 1px solid #ccc;'>/</td>";
        }
        echo "<td style='border-bottom: 1px solid #ccc;'>";

         //Section to add pilot names to the field  
          $current_iteration = 0;
          
          foreach($ShipObj->getPilots() as $pilot)
          {
          
            $pilotAdapter = new CurlHttpAdapter();
            $pilotresponse = $httpAdapter->getContent($pilot);

            $pilotData = json_decode( $pilotresponse->getBody(), true );
    
            if((count($ShipObj->getPilots()) - 1) != $current_iteration){
                echo " <b>name:</b> ".$pilotData['name'];
                echo " <b>height:</b> ".$pilotData['height'].", ";
            }
            else if((count($ShipObj->getPilots()) - 1) === $current_iteration){
                echo " <b>name:</b> ".$pilotData['name'];
                echo " <b>height:</b> ".$pilotData['height'];
            }

            $current_iteration++;

           }
        echo "</td>";
        echo "</tr>";
 
  }

echo "<table>";

