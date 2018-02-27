<?php
/**
 * Interface for sorting algorithms.
 */

namespace boardingcards\utlity\interfaces;

/**
 * Sort algorithms should implement this interface.
 */
interface SortInterface {
    /**
     * Sort method should implement.
     * @param array $cards
     */
    public static function sort($cards);
}