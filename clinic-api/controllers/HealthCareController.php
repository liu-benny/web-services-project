<?php

/**
 * A class for consuming the HealthCare API.
 */
class HealthCareController extends WebServiceInvoker{

    private $request_options = Array(
        'headers' => Array('Accept' => 'application/json')
    );

    public function __construct() {
        parent::__construct($this->request_options);
    }

    /**
     * Fetches and parses a list of books from the Ice and Fire API.
     * 
     * @return array containing some information about books. 
     */
    function getArticles() {
        $articlesData = Array();
        $resource_uri = "https://www.healthcare.gov/api/articles.json";
        $articlesData = $this->invoke($resource_uri);

        if (!empty($articlesData)) {
            // Parse the fetched list of books.   
            $articlesData = json_decode($articlesData, true);
            // var_dump($booksData);exit;

            // print_r($booksData["articles"][0]["content"]);
            $index = 0;
            // Parse the list of books and retreive some  
            // of the contained information.
            foreach ($articlesData["articles"] as $key => $article) {
                
                $articles["articles"][$index]["title"] = $article["title"];
                $articles["articles"][$index]["content"] = $article["content"];
               
                $index++;
            }
        }
        return $articles;
    }

}
