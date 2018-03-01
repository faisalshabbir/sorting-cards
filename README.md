# sorting-cards


### Dependencies
- PHP 7
- Any kind of *nix OS
- Default setiings is for *nix machine enviorment. 
- For runing the script in windows machine, modify the path in initialized.php 
- Comment out the *nix path and enable the windows path

For linux machine path : set_include_path(get_include_path() . ':' . __DIR__ . '/lib/');

For windows machine path : set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '\lib');

### Sorting Algorthim execution process

Sort function will use three static arrays to run whole sorting process.

Step 1 : Sort function set the provided array into unordereed array.

self::$unOrderedCards = $cards;

Step 2 : In step 2, sort function picks first value of unordered array and set it to the first element of ordered array and reset the pointer of unordered array

    if (count(self::$orderedCards) == 0) {
        array_push(self::$orderedCards, array_shift(self::$unOrderedCards));
    } 

Step 3 : Step 3 is the heart of the sort function. In step 3, sort function run the loop on unordered array and inside the loop set the source (fetch from the first element of the ordered array) and destination (fetch from the last element of the ordered array) variables. 

    //array internal pointer to the first element and returns the value of the first array element
    $source = reset(self::$orderedCards); 
    $source = $source->source;

    //array internal pointer to the last element, and returns its value.
    $destination = end(self::$orderedCards); 
    $destination = $destination->destination; 

Step 4 : After setting these two variables, function will check if source variable is equal to current unordered array destination or destination variable is equal to current unordered array source then proceed to step 5 in else case unordered array index is inserted into temp array

    if ($destination == $card->source || $source == $card->destination) {

    }else{
        unset(self::$tmp[$key]);
    }

Step 5 : In step 5, function perform 3 further conditions.
In first condition, current unordered array source value is compared with previously set destination variable. In case of success current unordered value is pushed into ordered array. 
    
    if ($card->source == $destination) {
        array_push(self::$orderedCards, $card);
    }

In second condition, current unordered array destination value is compared with previously set source variable. In case of success current unordered value is pushed into ordered array as a first index of the array.
    
    if ($card->destination == $source) {
        array_unshift(self::$orderedCards, $card);
    }

In third condition, current unordered array key index is checked into temp array and if found then removed from temp array

    if (isset(self::$tmp[$key])) {
        unset(self::$tmp[$key]);
    }

Note : Step 3, 4, 5 are done in a loop as mentioned in step 3. 

Step 6 : If temp array count is greater than zero then sort function will called recursively.

    if (count(self::$tmp) > 0) {
        self::sort(self::$tmp);
    }

If temp array found to be empty then function return the sorted array. 

### Sorting Algorthim performance

When data is already sorted then array will run one time means N of the array.
In test scenario when data is not sorted then sort function will run for each unordered element of the array. So maximum iteration in this case will be N square.
So conclusion about algorithm performance is N to N square.

### Card Type Details
* Default card type is TravelCard and default class is DefaultCard.
* You can create new type of cards whatever you want.
* For adding new card types, add new card type class file in types folder. Class name should end with "Card"


Files 
----------------------------------------------
    test
    └── index.php
    code
    ├── initialized.php
    └── lib
        └── boardingcards
            ├── cards
            │   ├── ProcessCard.php
            │   ├── types
            │   │   └── DefaultCard.php
            ├── operations
            │   └── travel
            │       └── ProcessTravel.php
            │   └── display
            │       └── DisplayCard.php
            └── utils
                ├── interfaces
                │   └── SortInterface.php
                └── sorters
                    └── ArraySort.php

Triggering test 
----------------------------------------------
$ php test/index.php


More Information 
----------------------------------------------
You can change cards input data in test/index.php

For enalbling the detail log about provided cards count and other details, please change $displayLogs = true in test/index.php file.

Sample Output 
----------------------------------------------
1 : Take train 78A from Madrid to Barcelona. Sit in seat 45B 

2 : Take the airport bus, from Barcelona to Gerona Airport. No seat assignment.

3 : From Gerona Airport, take plane SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.

4 : From Stockholm, take plane SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg

You have arrived at your final destination.

