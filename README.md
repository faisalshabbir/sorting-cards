# sorting-cards
==============================================


### Dependencies
- PHP 7
- Any kind of *nix OS


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

