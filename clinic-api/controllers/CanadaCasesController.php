<?php

/**
 * A class for consuming the Ice and Fire API.
 *
 * @author Sleiman Rabah
 */
class CanadaCasesController extends WebServiceInvoker {

    private $request_options = Array(
        'headers' => Array('Accept' => 'application/json')
    );

    public function __construct() {
        parent::__construct($this->request_options);
    }

    /**
     * Fetches and parses a list of cases from the Covid19 API.
     * 
     * @return array containing some information about books. 
     */
    function getTotalCases() {
        $cases = Array();
        $resource_uri = "https://api.covid19api.com/country/canada/status/confirmed";
        $casesData = $this->invoke($resource_uri);

        if (!empty($casesData)) {
            // Parse the fetched list of books.   
            $casesData = json_decode($casesData, true);
            //var_dump($booksData);exit;

            $index = 0;
            // Parse the list of books and retreive some  
            // of the contained information.
            foreach ($casesData as $key => $case) {
                $cases[$index]["Country"] =     $case["Country"];
                $cases[$index]["CountryCode"] = $case["CountryCode"];
                $cases[$index]["Cases"] =   $case["Cases"];
                $cases[$index]["Status"] =  $case["Status"];
                $cases[$index]["Date"] =    $case["Date"];
                
                //
                $index++;
            }
        }
        return $cases;
    }

}
