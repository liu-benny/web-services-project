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

    $requested_format = $request->getHeader('Accept');
    
    if($parse_data != null){

        foreach($parse_data as $clinic){
            if(!isset($clinic['clinic_name']) || !isset($clinic['clinic_address']) || !isset($clinic['clinic_details']) ){
                $response_data = makeCustomJSONMessage("Error","Record(s) has not been updated. Some fields are empty.");
                $response_code = HTTP_BAD_REQUEST;

                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
            else{
                $clinics = array("clinic_name" => $clinic['clinic_name'] , "clinic_address" => $clinic['clinic_address'],'clinic_details' => $clinic['clinic_details']);
                $clinic_model->createClinic($clinic);
            }
            
        }

        $response_data = makeCustomJSONMessage("Created","Record(s) has been successfully created.");
    }
    else{

        $response_data = makeCustomJSONMessage("Error","Record(s) has not been created. All fields are empty.");
        $response_code = HTTP_BAD_REQUEST;

    }

    if ($requested_format[0] != APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }

    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleUpdateClinics(Request $request,Response $response, array $args){
    
    $clinics = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $clinic_model = new clinicModel();

    $parse_data = $request->getParsedBody();

    $requested_format = $request->getHeader('Accept');
    
    if($parse_data !== null){
        
        foreach($parse_data as $clinic){
            if(!isset($clinic['clinic_id']) || !isset($clinic['clinic_name']) || !isset($clinic['clinic_address']) || !isset($clinic['clinic_details']) ){
                $response_data = makeCustomJSONMessage("Error","Record(s) has not been updated. Some fields are empty.");
                $response_code = HTTP_BAD_REQUEST;

                $response->getBody()->write($response_data);
                return $response->withStatus($response_code);
            }
            else{
                $clinics = array("clinic_name" => $clinic['clinic_name'] , "clinic_address" => $clinic['clinic_address'],'clinic_details' => $clinic['clinic_details']);
                $clinic_model->updateClinic($clinics,array("clinic_id" => $clinic['clinic_id']));
            }
            
        }

        $response_data = makeCustomJSONMessage("Updated","Record(s) has been successfully updated.");
    }
    else{

        $response_data = makeCustomJSONMessage("Error","Record(s) has not been updated. All fields are empty.");
        $response_code = HTTP_BAD_REQUEST;

    }

    if ($requested_format[0] !== APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }

    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Get all departments of a given clinic
 * URI: /clinics/{clinic_id}/departments
 */
function handleGetAllDepartments(Request $request, Response $response, array $args) {
    $departments = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $clinic_model = new ClinicModel();

    $clinic_id = $args["clinic_id"];

    if (isset($clinic_id)) {
        $departments = $clinic_model->getAllDepartments($clinic_id);
        if (!$departments) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $requested_format = $request->getHeader('Accept');
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($departments, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Create one or more departments for a given clinic
 * URI: /clinics/{clinic_id}/departments
 */
function handleCreateDepartments(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $clinic_model = new ClinicModel();
    for ($index = 0; $index < count($data); $index++) {
        $department = $data[$index];
        $department_id = $department["department_id"];
        $department_name = $department["department_name"];
        $clinic_id = $department['clinic_id'];

        $new_department_record = array(
            "department_id" => $department_id,
            "department_name" => $department_name,
            "clinic_id" => $clinic_id
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $clinic_model->createDepartments($new_department_record);
    }

    // Handle serve-side content negotiation and produce the requested representation.    
    $requested_format = $request->getHeader('Accept');
    
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Update one or more given department in a given clinic
 * URI: /clinics/{clinic_id}/departments
 */
function handleUpdateDepartments(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_OK;
    $data = $request->getParsedBody();

    $clinic_model = new ClinicModel();

    for ($index = 0; $index < count($data); $index++) {
        $department = $data[$index];
        $department_id = $department["department_id"];
        $department_name = $department["department_name"];
        $clinic_id = $department["clinic_id"];

        $updated_department_records = [
            'data' => [
                "department_name" => $department_name,
                "clinic_id" => $clinic_id
            ],
            'where' => [
                "department_id" => $department_id
            ]
        ];

        $clinic_model->updateDepartment($updated_department_records);
    }

    $requested_format = $request->getHeader('Accept');
    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Delete a given department in a given clinic
 * URI: /clinics/{clinic_id}/departments/{department_id}
 */
function handleDeleteDepartment(Request $request, Response $response, array $args) {
    $rowsCount = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $clinic_model = new ClinicModel();

    $department_id = $args["department_id"];

    if (isset($department_id)) {
        $rowsCount = $clinic_model->deleteDepartment($department_id);
        if (!$rowsCount) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified department.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $requested_format = $request->getHeader('Accept');
    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($rowsCount, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Get all doctors in a given clinic
 * URI: /clinics/{clinic_id}/doctors
 */
function handleGetAllDoctorInOneClinic(Request $request, Response $response, array $args) {
    $departments = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $clinic_model = new ClinicModel();

    $clinic_id = $args["clinic_id"];

    if (isset($clinic_id)) {
        $departments = $clinic_model->getAllDoctors($clinic_id);
        if (!$departments) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified clinic.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $requested_format = $request->getHeader('Accept');
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($departments, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}