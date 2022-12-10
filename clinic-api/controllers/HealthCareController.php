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
     * Retrieve a list of articles from the HealthCare API.
     * @return array
     */
    function getArticles() {
        $articlesData = Array();
        $resource_uri = "https://www.healthcare.gov/api/articles.json";
        $articlesData = $this->invoke($resource_uri);

        if (!empty($articlesData)) {
            
            $articlesData = json_decode($articlesData, true);
            
            $index = 0;
            // Parse the list of articles and retrieve some  
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
