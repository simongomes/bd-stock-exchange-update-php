# Dhaka & Chittagong Stock Exchange Update (DSE & CSE)

A PHP library to fetch updates from Bangladesh share market, including Dhaka and Chittagong Stock Exchange (DSE & CSE).

[DSE](https://www.dsebd.org), [CSE](http://www.cse.com.bd)

## Installation
Download the latest release.

[![Latest Version](https://img.shields.io/badge/release-v1.0.0-blue.svg?longCache=true&style=for-the-badge)](#)

#### Usages
- Include the library
```php
<?php
    require __DIR__ . '/lib/autoload.php';  
    use Simon\BDShareMarket;
```
- Create an object and call the necessary
```php
    $BDShareMarket = new BDShareMarket();
    
    // this will print the DSE data
    print_r($BDShareMarket->getDSEData());
```

#### Output
```
Array
(
    [0] => Array
        (
            [company] => 1JANATAMF
            [ltp] => 6.1
            [high] => 6.1
            [low] => 6.1
            [closep] => 6.1
            [ycp] => 6.2
            [change] => -0.1
            [trade] => 28
            [value] => 0.25
            [volume] => 40,942
        )

    [1] => Array
        (
            [company] => 1STPRIMFMF
            [ltp] => 11.4
            [high] => 11.4
            [low] => 11.2
            [closep] => 11.4
            [ycp] => 11.2
            [change] => 0.2
            [trade] => 107
            [value] => 1.973
            [volume] => 174,194
        )

    [2] => Array
        (
            [company] => AAMRANET
            [ltp] => 91.2
            [high] => 92
            [low] => 85.3
            [closep] => 91
            [ycp] => 84.2
            [change] => 7
            [trade] => 3,011
            [value] => 144.176
            [volume] => 1,616,666
        )
        ...
```

## License

[![License](https://img.shields.io/github/license/mashape/apistatus.svg?longCache=true&style=for-the-badge)](http://opensource.org/licenses/MIT)

Copyright (c) 2018, <a href="https://simongomes.me" target="_blank">Simon Gomes</a>