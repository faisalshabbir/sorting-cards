<?php
/**
 * Class for Display Cards details after processing
 */

namespace boardingcards\operations\display;

use \Exception;

class DisplayCard {
  
  protected $pCards;
  
  /**
   * Constructor for the DisplayCard.
   * @param array $card
   */
  function __construct(array $card) {
    
    if( count($card) > 0 ){
      $this->pCards = $card;
      return $this;
    }else{
      throw new Exception('Dont have any data to display');
    }
  }

  function getpCards(){
    return $this->pCards;
  }

  function getTemplateType($card){
    if(strpos(strtolower($card->destination), 'airport') !== false && strpos(strtolower($card->source), 'airport') === false){
      return 1;
    }else if(strpos(strtolower($card->destination), 'airport') === false && strpos(strtolower($card->source), 'airport') !== false){
      return 2;
    }else if(strpos(strtolower($card->destination), 'airport') === false && strpos(strtolower($card->source), 'airport') === false){
      if(in_array(strtolower($card->vehicle),array('plane','flight'))){
        return 2;
      }else{
        return 3;
      }
    }
  }

  public function __toString()
  {
    $cards = $this->getpCards();
    foreach($cards as $key => $card){
      $displayType = $this->getTemplateType($card);
      if($displayType === 1){
        echo $this->dTemplate($card);
      }elseif($displayType === 2){
        echo $this->sTemplate($card);
      }elseif($displayType === 3){
        echo $this->rTemplate($card);
      }
      echo PHP_EOL;
    }
    $this->finalDestination();
  }

  function finalDestination(){
    echo 'You have arrived at your final destination.' . PHP_EOL;
  }

  function dTemplate($card){
    $str  = '';
    $str .= $this->getVehicle($card,'Take the airport ',',');
    $str .= $this->getVehicleNo($card,'',' ');
    $str .= $this->getSource($card,'from ',' ').$this->getDestination($card,'to ','. ');
    $str .= $this->getGate($card,'',','); 
    $str .= $this->getSeat($card,'','');
    $str .= $this->getbaggage($card,'','');
    return $str;
  }

  function sTemplate($card){
    $str  = '';
    $str .= $this->getSource($card,'From ',', ');
    $str .= $this->getVehicle($card,'take ',' ');
    $str .= $this->getVehicleNo($card,'',' ');
    $str .= $this->getDestination($card,'to ','. ');
    $str .= $this->getGate($card,'Gate ',', '); 
    $str .= $this->getSeat($card,'seat ','. ');
    $str .= $this->getbaggage($card,'','');
    return $str;
  }

  function rTemplate($card){
    $str  = '';
    $str .= $this->getVehicle($card,'Take ',' ');
    $str .= $this->getVehicleNo($card,'',' ');
    $str .= $this->getSource($card,'from ',' ').$this->getDestination($card,'to ','. ');
    $str .= $this->getSeat($card,'Sit in seat ',' ');
    $str .= $this->getGate($card,'from the gate ','. '); 
    $str .= $this->getbaggage($card,'','');
    return $str;
  }


  function getSource($card , $pre_string, $post_string){
    return !isset($card->source) && $card->source != '' ? $pre_string.$card->source.$post_string : "";
  }

  function getDestination($card , $pre_string, $post_string){
    return !isset($card->vehicle) && $card->destination != '' ? $pre_string.$card->destination.$post_string : "";
  }


  function getVehicle($card , $pre_string, $post_string){
    return !isset($card->vehicle) && $card->vehicle != '' ? $pre_string.$card->vehicle.$post_string : "";
  }

  function getVehicleNo($card , $pre_string, $post_string){
    return !isset($card->vehicleNo) && $card->vehicleNo != '' ? $pre_string.$card->vehicleNo.$post_string : "";
  }

  function getSeat($card , $pre_string, $post_string){
    return !isset($card->seat) && $card->seat != '' ? $pre_string.$card->seat.$post_string : "";
  }

  function getGate($card , $pre_string, $post_string){
    return !isset($card->gate) && $card->gate != ''  ? $pre_string.$card->gate.$post_string : "";
  }

  function getbaggage($card , $pre_string, $post_string){
    return !isset($card->baggage) && $card->baggage != ''  ? $pre_string.$card->baggage.$post_string : "";
  }

  
  
/*  public function toString(){
    $cards = $this->getpCards();
    foreach($cards as $key => $card){      
      $str = ($key+1).' : ';
     if(strpos(strtolower($card->destination), 'airport') !== false && strpos(strtolower($card->source), 'airport') === false ){
        
      }else if(strpos(strtolower($card->destination), 'airport') === false && strpos(strtolower($card->source), 'airport') !== false ){

      }else if(strpos(strtolower($card->destination), 'airport') === false && strpos(strtolower($card->source), 'airport') === false ){
        if(in_array(strtolower($card->vehicle),array('plane','flight'))){
          $str .= "From ".$card->source.", ";
          $str .= "take ". $card->vehicle." ";
          $str .= !isset($card->vehicleNo) && $card->vehicleNo != '' ? $card->vehicleNo." " : "";
          $str .= "to ".$card->destination.". ";
          $str .= !isset($card->gate) && $card->gate != ''  ? "Gate ".$card->gate.", " : ""; 
          $str .= !isset($card->seat) && $card->seat != '' ? "seat ".$card->seat.". " : "";
        }else{
          $str .= "Take ".$card->vehicle ." ";
          $str .= !isset($card->vehicleNo) && $card->vehicleNo != '' ? $card->vehicleNo." " : "";
          $str .= "from ".$card->source." to ".$card->destination.". ";
          $str .= !isset($card->seat) && $card->seat != '' ? "Sit in seat ".$card->seat." " : "";
          $str .= !isset($card->gate) && $card->gate != ''  ? "from the gate ".$card->gate."." : "";  
        }  
      }



      echo $str;
      echo PHP_EOL;	

      if ($key == count($this->cards) -1 ) {
        echo 'You have arrived at your final destination.' . PHP_EOL;
        break;
      }

    }
  }*/

  
}