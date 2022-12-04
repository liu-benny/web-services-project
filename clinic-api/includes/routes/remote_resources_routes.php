<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';

function handleGetCanadaCases(Request $request, Response $response, array $args){

    $response_code = HTTP_OK;

    $cases = Array();
    // Get books data from the Ice and Fire API.
    $canadaCases = new CanadaCasesController();
    $cases = $canadaCases->getTotalCases();
    // Combine the data sets.
    $jsonData = json_encode($cases, JSON_INVALID_UTF8_SUBSTITUTE);

    $requested_format = $request->getHeader('Accept');

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($cases, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}
?>