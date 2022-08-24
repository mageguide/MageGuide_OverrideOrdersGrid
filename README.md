# MageGuide OverrideOrdersGrid
Not Tested

## Description
Adds backend user's name in the orders grid, for orders that are created in the admin area

## Functionalities
- Overrides backend Order Grid Ui file in order to show the backend user responsible for submitting an order

## Installation
- Upload module files in ``app/code/MageGuide/OverrideOrdersGrid``
- Install module
```sh
        $ php bin/magento module:enable MageGuide_OverrideOrdersGrid
        $ php bin/magento setup:upgrade
        $ php bin/magento setup:di:compile
```

## ToDo
Module needs to apply admins information to a submitted order and then show this info in the Order Grid