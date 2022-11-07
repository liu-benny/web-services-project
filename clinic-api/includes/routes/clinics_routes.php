<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ClinicModel.php';

// Callback for HTTP GET /clinics
function handleGetAllClinics(Request $request, Response $response, array $args){
    $clinics = array();
    $response_data = array();
    $response_code = HTTP_OK;

    $clinic_model = new ClinicModel();

    // -- put filters here
    // $filter_params = $request->getQueryParams();

    $clinics = $clinic_model->getAllClinics();

    $requested_format = $request->getHeader('Accept');

    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($clinics, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);

}

// Callback for HTTP POST /clinics
function handleCreateClinics(Request $request,Response $response, array $args){
    
    $clinics = array();
    $response_data = array();
    $response_code = HTTP_CREATED;

    $clinic_model = new ClinicModel();

    $parse_data = $request->getParsedBody();

    foreach($parse_data as $clinic){
        $clinics = array("clinic_name" => $clinic['clinic_name'] , "clinic_address" => $clinic['clinic_address'],'clinic_details' => $clinic['clinic_details']);
        $clinic_model->createClinic($clinic);
    }

    $requested_format = $request->getHeader('Accept');

    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = makeCustomJSONMessage("Created","Record(s) has been successfully created.");
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}