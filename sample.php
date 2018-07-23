<?php
require __DIR__ . '/lib/autoload.php';

use Simon\BDShareMarket;

$BDShareMarket = new BDShareMarket();

echo "<pre>";
// To print DSE data enable this
print_r($BDShareMarket->getDSEData());

// To print DSE data for specific company replace COMPANY_NAME and enable this
//print_r($BDShareMarket->getDSECompanyData('COMPANY_NAME'));

// To print CSE data enable this
//print_r(json_encode($BDShareMarket->getCSEData()));

// To print CSE data for specific company replace COMPANY_NAME and enable this
//print_r($BDShareMarket->getCSECompanyData('COMPANY_NAME'));