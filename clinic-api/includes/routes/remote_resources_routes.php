<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ClinicModel.php';


function handleGetCanadaCases(Request $request, Response $response, array $args){

    $response_code = HTTP_OK;

    $cases = Array();
    // Get books data from the Ice and Fire API.
    $canadaCases = new CanadaCasesController();
    $clinic_model = new ClinicModel();
    $cases = $canadaCases->getTotalCases();
    $clinics = $clinic_model->getAllClinics();

    // Combine the data sets.
    $clinic_and_cases["clinic"] = $clinics;
    $clinic_and_cases["cases"] = $cases;
    
    $requested_format = $request->getHeader('Accept');

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($clinic_and_cases, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * 
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
function getClinicAndArticlesResource(Request $request, Response $response, array $args) {

    $clinic_and_articles = Array();
    $response_code = HTTP_OK;
    
    // Get books data from the Ice and Fire API.
    $healthCareArticles = new HealthCareController();
    // Set the pagination options.
    $articles = $healthCareArticles->getArticles();
    // Get the info of a given clinics. 
    $clinic_model = new ClinicModel();
    $clinic_id = $args["clinic_id"];

    if (isset($clinic_id)) {
        $clinic = $clinic_model->getClinicById($clinic_id);
        if (!$clinic) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $clinic = $clinic_model->getClinicById($clinic_id);

    // Combine the data sets.
    $clinic_and_articles["clinic"] = $clinic;
    $clinic_and_articles["articles"] = $articles;
    // $jsonData = json_encode($clinic_and_articles, JSON_INVALID_UTF8_SUBSTITUTE);
    // echo $jsonData;

    $requested_format = $request->getHeader('Accept');

    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($clinic_and_articles, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}
?>