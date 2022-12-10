<?php


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
     * @return array containing some information about cases. 
     */
    function getTotalCases() {
        $cases = Array();
        $resource_uri = "https://api.covid19api.com/country/canada/status/confirmed";
        $casesData = $this->invoke($resource_uri);

        if (!empty($casesData)) {
            
            $casesData = json_decode($casesData, true);
            
            $index = 0;
            // Parse the list of cases and retrieve some  
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
