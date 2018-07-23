<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 7/16/2018
 * Time: 6:14 PM
 */

namespace Simon;

use DOMDocument;
use DOMXPath;

class DSEUpdate {
    private $siteUrl;
    private $companyName;

    public function __construct($siteUrl = 'https://www.dsebd.org/latest_share_price_all.php') {
        $this->siteUrl = $siteUrl;
    }

    /**
     * Sets the Site URL
     * @param $siteUrl
     */
    public function setSiteUrl($siteUrl) {
        $this->siteUrl = $siteUrl;
    }

    /**
     * Returns the Site URL
     * @return string
     */
    public function getSiteUrl() {
        return $this->siteUrl;
    }

    /**
     * @return array
     * Fetches and returns latest update from DSE
     */
    public function getData() {
        $htmlData = $this->getSiteContent($this->siteUrl);
        $DOM = new DOMDocument();
        @$DOM->loadHTML($htmlData);
        $htmlContents = new DOMXPath($DOM);

        $array = array();

        $counter = 0;
        $index = 0;

        foreach ($htmlContents->query("//table //tr //td") as $key => $node) {

            if( $key <= 10 ) continue;
            if( $counter > 10 ) {$counter = 0; $index++;}
            if($counter) {
                switch ($counter) {
                    case 1: $array[$index]['company'] = trim($node->nodeValue); break;
                    case 2: $array[$index]['ltp'] = $node->nodeValue; break;
                    case 3: $array[$index]['high'] = $node->nodeValue; break;
                    case 4: $array[$index]['low'] = $node->nodeValue; break;
                    case 5: $array[$index]['closep'] = $node->nodeValue; break;
                    case 6: $array[$index]['ycp'] = $node->nodeValue; break;
                    case 7: $array[$index]['change'] = $node->nodeValue; break;
                    case 8: $array[$index]['trade'] = $node->nodeValue; break;
                    case 9: $array[$index]['value'] = $node->nodeValue; break;
                    case 10: $array[$index]['volume'] = $node->nodeValue; break;
                }
            }
            $counter++;
        }

        return $array;
    }

    /**
     * @param $company_name
     * @return array
     * * Fetches and returns data of provided company
     */
    public function getCompanyData($company_name) {
        $this->companyName = $company_name;
        $allData = $this->getData();

        $companyData = array_filter($allData, function($item) {
            return $item['company'] === $this->companyName;
        });

        return array_pop($companyData);
    }

    /**
     * @param $siteUrl
     * @return mixed
     * Makes cURL request to fetch the data
     */
    protected function getSiteContent($siteUrl) {
        $ch = curl_init ($siteUrl);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec ($ch);
        curl_close ($ch) ;
        return ($response);
    }

}