<?php
/**
 * Usage:
 * ArraySort::sort($array);
 * 
 * Description: source & destination keys are required for sorting
 * 
 * If there is no member which has same source with any other element's destination value
 * then its the last element of the array.
 * Otherwise there should be other member which has same value in its source.
 * 
 * @param $cards array with minimum two count
 */

namespace boardingcards\utlity\sorters;

use \boardingcards\utlity\interfaces\SortInterface;
use \Exception;

/**
 * Sorts an array depends their source and destination.
 */
class ArraySort implements SortInterface {
  
  /**
   * for for unOrdered cards
   */
  protected static $unOrderedCards;
  
  /**
   * for ordered cards
   */
  protected static $orderedCards = array();
  
  /**
   * for temprarory cards.
   */
  protected static $tmp = array();
  
  /**
   * Sorts and returns the array
   * @param array $cards
   * @return array
   */
  public static function sort($cards){
    
    self::$unOrderedCards = $cards;
    
    // take an element from $items ant push it to self::$arranged array
    if (count(self::$orderedCards) == 0) {
        array_push(self::$orderedCards, array_shift(self::$unOrderedCards));
    }

    foreach (self::$unOrderedCards as $key => $card) {
      if (!$card->source || !$card->destination) {
        throw new Exception("source and destination members are mandatory");
      }

      //nternal pointer to the first element and returns the value of the first array element
      $source = reset(self::$orderedCards); 
      $source = $source->source;
      
      //internal pointer to the last element, and returns its value.
      $destination = end(self::$orderedCards); 
      $destination = $destination->destination;
      
      if ($destination == $card->source || $source == $card->destination) {
        
        if ($card->source == $destination) {
          array_push(self::$orderedCards, $card);
        }
        
        //prepends passed elements to the front of the array
        if ($card->destination == $source) {
          array_unshift(self::$orderedCards, $card);
        }

        //if already set in tmp then remove it.
        if (isset(self::$tmp[$key])) {
          unset(self::$tmp[$key]);
        }
        
      }
      else {
        array_push(self::$tmp, $card);
      }
    }
    
    if (count(self::$tmp) > 0) {
      self::sort(self::$tmp);
    }
    
    return self::$orderedCards;
  }
}