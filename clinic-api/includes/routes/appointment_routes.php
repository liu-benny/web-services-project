<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/AppointmentModel.php';

// Callback for HTTP GET /clinics/{clinic_id}/appointments
function handleGetAppointmentsByClinicId(Request $request, Response $response, array $args){
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);
    // Set default values if one of the following was invalid.
    $page_number = ($input_page_number > 0) ? $input_page_number : 1;
    $per_page = ($input_per_page > 0) ? $input_per_page : 10;

    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;

    $appointment_model = new AppointmentModel();
    // Set the pagination options.
    $appointment_model->setPaginationOptions($page_number, $per_page);

    $clinic_id = $args['clinic_id'];

    if (isset($clinic_id)) {
        $appointments = $appointment_model->getAppointmentsByClinicId($clinic_id);
        if (!$appointments) {
            $response_data = makeCustomJSONError("resourceNotFound", "No record was found for the specified clinic.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $requested_format = $request->getHeader('Accept');

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($appointments, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Callback for HTTP GET /patients/{patient_id}/appointments
function handleGetAppointmentsByPatientId(Request $request, Response $response, array $args) {
    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);
    // Set default values if one of the following was invalid.
    $page_number = ($input_page_number > 0) ? $input_page_number : 1;
    $per_page = ($input_per_page > 0) ? $input_per_page : 10;
    
    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;
    
    $appointment_model = new AppointmentModel();
    
    // Set the pagination options.
    $appointment_model->setPaginationOptions($page_number, $per_page);

    $patient_id = $args['patient_id'];

    $filter_params = $request->getQueryParams();

    if (isset($patient_id, $filter_params["date"])) {
        // Fetch the list of artists matching the provided genre.
        $appointments = $appointment_model->getAppointmentsByDate($patient_id, $filter_params["date"]);
    }   
    else {
        $appointments = $appointment_model->getAppointmentsByPatientId($patient_id);
    }
    $requested_format = $request->getHeader('Accept');
    if (!$appointments) {
        $response_data = makeCustomJSONError("resourceNotFound", "No record was found for the specified patient.");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($appointments, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Callback for HTTP GET /clinics/{clinic_id}/patients/{patient_id}/appointments
function handleGetAppointmentsByClinicAndPatientId(Request $request, Response $response, array $args){
    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;

    $appointment_model = new AppointmentModel();

    $clinic_id = $args['clinic_id'];
    $patient_id = $args['patient_id'];

    $filter_params = $request->getQueryParams();

    if (isset($clinic_id) && isset($patient_id)) {
        if($filter_params["date"]){
            $appointments = $appointment_model->getAppointmentsByClinicAndPatientIdAndDate($clinic_id, $patient_id, $filter_params["date"]);
        }
        else{
            $appointments = $appointment_model->getAppointmentsByClinicAndPatientId($clinic_id,$patient_id);

        } 
        if (!$appointments) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified clinic and/or patient.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }

    
    $requested_format = $request->getHeader('Accept');

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($appointments, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Callback for HTTP POST /patients/{patient_id}/appointments
function handleCreateAppointmentByPatientId(Request $request, Response $response, array $args){

    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $appointment_model = new AppointmentModel();

    $patient_id = $args['patient_id'];

    $parse_data = $request->getParsedBody();

    $requested_format = $request->getHeader('Accept');
    
    if ($requested_format[0] !== APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;

        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    }


    if(isset($patient_id)){
        
        if($parse_data !== null){
        
            foreach($parse_data as $appointment){
                if(!isset($appointment['doctor_id']) || !isset($appointment['clinic_id']) || !isset($appointment['time_from']) || !isset($appointment['time_to']) || !isset($appointment['status'])){
                    $response_data = makeCustomJSONMessage("Error","Record(s) has not been created. Some fields are empty.");
                    $response_code = HTTP_BAD_REQUEST;
    
                    $response->getBody()->write($response_data);
                    return $response->withStatus($response_code);
                }
                else{
                    $appointments = array("patient_id" => $patient_id,
                                    "doctor_id" => $appointment['doctor_id'] , 
                                    "clinic_id" => $appointment['clinic_id'],
                                    "time_from" => $appointment['time_from'], 
                                    "time_to" => $appointment['time_to'], 
                                    "status" => $appointment['status']);
                    $appointment_model->createAppointments($appointments);
                }
            }
    
            $response_data = makeCustomJSONMessage("Created","Record(s) has been successfully created.");
        }
        else{
    
            $response_data = makeCustomJSONMessage("Error","Record(s) has not been created. All fields are empty.");
            $response_code = HTTP_BAD_REQUEST;
    
        }
    }


    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

// Callback for HTTP PUT /patients/{patient_id}/appointments
function handleUpdateAppointmentByPatientId(Request $request,Response $response, array $args){
    
    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $appointment_model = new AppointmentModel();

    $patient_id = $args['patient_id'];

    $parse_data = $request->getParsedBody();

    $requested_format = $request->getHeader('Accept');
    
    if ($requested_format[0] !== APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;

        $response->getBody()->write($response_data);
        return $response->withStatus($response_code);
    }


    if(isset($patient_id)){
        
        if($parse_data !== null){
            
            
                if(!isset($parse_data[0]['doctor_id']) || !isset($parse_data[0]['clinic_id']) || !isset($parse_data[0]['time_from']) || !isset($parse_data[0]['time_to']) || !isset($parse_data[0]['status'])){
                    $response_data = makeCustomJSONMessage("Error","Record has not been updated. Some fields are empty.");
                    $response_code = HTTP_BAD_REQUEST;
    
                    $response->getBody()->write($response_data);
                    return $response->withStatus($response_code);
                }
                else{
                    $appointments = array("patient_id" => $patient_id,
                                    "doctor_id" => $parse_data[0]['doctor_id'] , 
                                    "clinic_id" => $parse_data[0]['clinic_id'],
                                    "time_from" => $parse_data[0]['time_from'], 
                                    "time_to" => $parse_data[0]['time_to'], 
                                    "status" => $parse_data[0]['status']);
                    $appointment_model->updateAppointments($appointments,$patient_id);
                }
             
            
    
            $response_data = makeCustomJSONMessage("Updated","Record has been successfully updated.");
        }
        else{
    
            $response_data = makeCustomJSONMessage("Error","Record has not been updated. All fields are empty.");
            $response_code = HTTP_BAD_REQUEST;
    
        }
    }


    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}


?>