<?php
/**
  * ProcessCard class for type based cards.
 */
namespace boardingcards\cards;

use \boardingcards\cards\types\DefaultCard as DefaultCard;
use \Exception;

/**
 * Default card type is travel card, if card type is not defined then creates an instance of DefaultCard.
 */

abstract class ProcessCard{
    
    /**
     * Creates an instance of a card from respective card class.
     * @return DefaultCard If $card['type] is not defined then it returns DefaultCard as default.
     * @param array $card []
     */
    public static function create($card) {
    
      if (!isset($card['type']) || ( $card['type'] == '' || $card['type'] == null ) ) {
        return new DefaultCard($card);
      }
      else {
        /**
          * Card type should end with the word "Card"
          */
        try {
          return new $card['type'] . 'Card';
        }
        catch (Exception $e) {
          throw new Exception($card['type'] . 'Card' . ' class not found! ' . $e);
        }
      }
    }
}
