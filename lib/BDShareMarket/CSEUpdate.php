<?php
/**
 * Created by PhpStorm.
 * User: SIMON
 * Date: 7/16/2018
 * Time: 3:56 PM
 */

namespace Simon;

use DOMDocument;
use DOMXPath;

class CSEUpdate {

    private $siteUrl;
    private $companyName;

    public function __construct($siteUrl = 'http://cse.com.bd/current_share_price_tc.php') {
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
     * Fetches and returns latest update from CSE
     */
    public function getData() {
        $htmlData = $this->getSiteContent($this->siteUrl);
        $DOM = new DOMDocument();
        @$DOM->loadHTML($htmlData);
        $htmlContents = new DOMXPath($DOM);

        $array = array();

        foreach ($htmlContents->query("//table[contains(concat(' ',normalize-space(@id),' '),' report ')] //tr") as $key => $node) {
            if( !$key ) continue;
            $array[] = $this->cleanData($node->nodeValue);
        }

        return $array;
    }

    /**
     * @param $company_name
     * @return array
     * Fetches and returns data of provided company
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
     * @param $data
     * @return array
     * Beautify and makes the fetched data human readable
     */
    protected function cleanData($data = null)
    {
        $data = utf8_decode($data);
        preg_match_all('([\w-\.]+)', $data, $cleaned);
        return $newArray = array(
            'company'       => $cleaned[0][1],
            'ltp'           => $cleaned[0][2],
            'high'          => $cleaned[0][3],
            'low'           => $cleaned[0][4],
            'ycp'           => $cleaned[0][5],
            'close_price'   => $cleaned[0][6],
            'change'        => $cleaned[0][7],
            'trade'         => $cleaned[0][8],
            'volume'        => $cleaned[0][9]
        );
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