<?php
/**
 * class for Process Travel list .
 * Sorts the stack of cards.
 */

 namespace boardingcards\operations\travel;

 use \boardingcards\utlity\sorters\ArraySort as CardSort;
 use \boardingcards\cards\BaseCard;
 use \Exception;

/**
 * You could able to order the trip cards by calling sortCards() method.
 * @param array $cards An array of the any card class.
 */
class ProcessTravel {
  
  /**
   * An unordered array of Card class.
  */
  public $cards = null;
  
  /**
   * Constructor of the ProcessTravel
   * @param array $cards An array of unsorted cards.
   * @return ProcessTravel object (this) 
   */
  function __construct($cards) {
    $this->setCards($cards);
    return $this;
  }
  
  /**
   * returns an array of cards.
   */
  public function getCards() {
    return $this->cards;
  }
  
  /**
   * Setter for cards
   * @param array $cards an array of unsorted cards.
   */
  public function setCards(array $cards){
    $this->cards = $cards;
  }
  
  /**
   * Sorts the cards array
   */
  public function sortCards() {
    $this->cards = CardSort::sort($this->cards);
  }

  /**
   * hepler function for sorting and returning the cards
   */
  public function process(){
    $this->sortCards();
  }

  /**
   * hepler function to get the result
   * May need to modify the logic when new cardTypes added
   */
  public function __toString(){
    $cards = $this->getCards();
    foreach($cards as $key => $card){      
      $str = ($key+1).' : ';
     if(strpos(strtolower($card->destination), 'airport') !== false && strpos(strtolower($card->source), 'airport') === false ){
        $str .= "Take the airport ".$card->vehicle.", ";
        $str .= !isset($card->vehicleNo) && $card->vehicleNo != '' ? $card->vehicleNo." " : "";
        $str .= "from ".$card->source." to ".$card->destination.". ";
        $str .= !isset($card->gate) && $card->gate != ''  ? "".$card->gate.", " : ""; 
        $str .= !isset($card->seat) && $card->seat != '' ? "".$card->seat."" : "";
      }else if(strpos(strtolower($card->destination), 'airport') === false && strpos(strtolower($card->source), 'airport') !== false ){
        $str .= "From ".$card->source.", ";
        $str .= "take ". $card->vehicle." ";
        $str .= !isset($card->vehicleNo) && $card->vehicleNo != '' ? $card->vehicleNo." " : "";
        $str .= "to ".$card->destination.". ";
        $str .= !isset($card->gate) && $card->gate != ''  ? "Gate ".$card->gate.", " : ""; 
        $str .= !isset($card->seat) && $card->seat != '' ? "seat ".$card->seat.". " : "";
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

      if( !isset($card->baggage) && $card->baggage != '' ){
        $str .= $card->baggage;
      }

      echo $str;
      echo PHP_EOL;	

      if ($key == count($this->cards) -1 ) {
        echo 'You have arrived at your final destination.' . PHP_EOL;
        break;
      }

    }
  }

}