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
    doc
    └── [Documentation]
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
