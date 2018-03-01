<?php
/**
 * class for Process Travel list .
 * Sorts the stack of cards.
 */

 namespace boardingcards\operations\travel;

 use \boardingcards\utlity\sorters\ArraySort as CardSort;
 use \boardingcards\cards\BaseCard;
 use \boardingcards\operations\display\DisplayCard;
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
    $displayCard = new DisplayCard($cards);
    $displayCard->__toString();
    
  }

}