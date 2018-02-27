<?php
/**
 * Index (test) file for verfification of boarding cards sorting problem. 
 */
$displayLogs = false; 
if($displayLogs == true){
  echo PHP_EOL;	
  echo '===================================' . PHP_EOL;   
  echo 'Boarding cards sorting test script' . PHP_EOL;
  echo '===================================' . PHP_EOL;
  echo PHP_EOL;
}


/**
 * Initialized file for boarding cards sorting solution.
 */

require_once __DIR__ . '/../code/initialized.php';

use \boardingcards\cards\ProcessCard;
use \boardingcards\operations\travel\ProcessTravel;

/**
 * Array of Cards.
 * Array without type key will considered as DefaultCard
 * Default card type is travel card
 */
  $card_to_test = array(
    array(
      'source' => 'Barcelona',
      'destination' => 'Gerona Airport',
      'vehicle' => 'bus',
      'seat' => 'No seat assignment.',
      'gate' => null
    ),
    array(
      'source' => 'Madrid',
      'destination' => 'Barcelona',
      'vehicle' => 'train',
      'vehicleNo' => '78A',
      'seat' => '45B',
      'gate' => null
    ),
    array(
      'source' => 'Gerona Airport',
      'destination' => 'Stockholm',
      'vehicle' => 'plane',
      'vehicleNo' => 'SK455',
      'seat' => '3A',
      'gate' => '45B',
      'baggage' => 'Baggage drop at ticket counter 344.'
    ),
    array(
      'source' => 'Stockholm',
      'destination' => 'New York JFK',
      'vehicle' => 'plane',
      'vehicleNo' => 'SK22',
      'seat' => '7B',
      'gate' => '22',
      'baggage' => 'Baggage will we automatically transferred from your last leg'
    )
);
if($displayLogs == true){
  echo PHP_EOL;	
  echo 'Provided Cards data : '.Count($card_to_test) . PHP_EOL;
}

$cards = array();
foreach ($card_to_test as $testCard) {
  try{
    array_push($cards, ProcessCard::create($testCard));
    if($displayLogs == true){
      echo PHP_EOL;
      echo "Pass : Card object created successfully for source ".$testCard['source']." & ".$testCard['destination'] ;
    }  
  }catch(Exception $e){
    echo PHP_EOL;	
    echo "Fail : Card constructur get failed due to ", $e->getMessage();
    echo PHP_EOL;
  }
}
$cardCounts = count($cards);

if($displayLogs == true){
  echo PHP_EOL; 
  echo 'Total Cards Objects founds : '.$cardCounts . PHP_EOL; 
}  
if ( $cardCounts > 0 ) {
  $processTravel = new ProcessTravel($cards);
  if($cardCounts > 1){
    $processTravel->process();
    $processTravel->__toString();
  }else{
    $processTravel->__toString();
  }
}else{
  echo PHP_EOL;
  echo "No cards object found to process";	
}
?>