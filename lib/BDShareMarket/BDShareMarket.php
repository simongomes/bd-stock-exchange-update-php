<?php
/**
 * Author: Simon Gomes
 * Author URL: http://busysimon.com
 */

namespace Simon;

class BDShareMarket {

    // CSE Updates
    /**
     * @return array
     * Returns CSE Latest Update
     */
    public function getCSEData() {
        $CSEUpdate = new CSEUpdate();
        return $CSEUpdate->getData();
    }

    /**
     * @param $company_name
     * @return array
     * Returns CSE Latest Update for specific Company
     */
    public function getCSECompanyData($company_name) {
        $CSEUpdate = new CSEUpdate();
        return $CSEUpdate->getCompanyData($company_name);
    }


    // DSE Updates
    /**
     * @return array
     * Returns CSE Latest Update
     */
    public function getDSEData() {
        $DSEUpdate = new DSEUpdate();
        return $DSEUpdate->getData();
    }

    /**
     * @param $company_name
     * @return array
     * Returns CSE Latest Update for specific Company
     */
    public function getDSECompanyData($company_name) {
        $DSEUpdate = new DSEUpdate();
        return $DSEUpdate->getCompanyData($company_name);
    }

}