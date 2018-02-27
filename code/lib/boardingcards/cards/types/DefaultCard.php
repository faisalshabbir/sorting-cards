<?php
/**
 * Class for default card
 */

namespace boardingcards\cards\types;

use \Exception;

class DefaultCard {
  
  /**
   * Source point of the card.
   */
  protected $source;
  
  /**
   * Destination of the card.
   */
  protected $destination;
  
  /**
   * Vehicle type of the card.
   */
  protected $vehicle;

  /**
   * Vehicle No of the card.
   */
  protected $vehicleNo;
  
  /**
   * Seat number of the card.
   */
  protected $seat;
  
  /**
   * Gate # of the card.
   */
  protected $gate;

  /**
   * baggage of the card.
   */
  protected $baggage;

  /**
   * Default card type for testing purpose.
   */
  protected $type = 'TravelCard';
  
  /**
   * Constructor for the DefaultCard class.
   * source & destination keys are complusory for object constructions
   * @param array $card
   */
  function __construct(array $card) {
    
    if( (isset($card['source'])  && $card['source'] != null) && ( isset($card['destination']) && $card['destination'] != null) ){
      $this->source      = $card['source'];
      $this->destination = $card['destination'];
      $this->vehicle     = isset($card['vehicle']) && $card['vehicle'] != null ? $card['vehicle'] : null ;
      $this->vehicleNo   = isset($card['vehicleNo']) && $card['vehicleNo'] != null ? $card['vehicleNo'] : null ;
      $this->seat        = isset($card['seat']) && $card['seat'] != null ? $card['seat'] : null ;
      $this->gate        = isset($card['gate']) && $card['gate'] != null ? $card['gate'] : null ;
      $this->baggage     = isset($card['baggage']) && $card['baggage'] != null ? $card['baggage'] : null ;
      return $this;
    }else{
      throw new Exception('Source & destination keys are required to construct card object');
    }
  }
  
  /**
   * getter function
   * @param string $property 
   */
  public function __get($property)
  {
    if (property_exists($this, $property)) {
        return $this->$property;
    }
  }
  
}