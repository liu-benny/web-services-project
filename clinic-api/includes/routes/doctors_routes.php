<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/DoctorModel.php';

/**
 * Retrieve all doctors from the `doctors` table.
 * URI: /doctors
 */
function handleGetAllDoctors(Request $request, Response $response, array $args) {
    $doctors = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $doctor_model = new DoctorModel();


    $doctors = $doctor_model->getAllDoctors();
    if (!$doctors) {
        $response_data = makeCustomJSONError("resourceNotFound", "No record was found.");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }
    
    $requested_format = $request->getHeader('Accept');
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($doctors, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Retrive information about a given doctor
 * URI: /doctors/{doctor_id}
 */
function handleGetDoctorById(Request $request, Response $response, array $args)
{
    $doctor_info = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $doctor_model = new DoctorModel();

    // Retreive the artist id from the request's URI.
    $doctor_id = $args["doctor_id"];
    if (isset($doctor_id)) {
        // Fetch the info about the specified artist.
        $doctor_info = $doctor_model->getDoctorById($doctor_id);
        if (!$doctor_info) {
            // No matches found?
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified artist.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    // Handle serve-side content negotiation and produce the requested representation.    
    $requested_format = $request->getHeader('Accept');
    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($doctor_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Create one or multiple doctors
 * URI: /doctors
 */
function handleCreateDoctors(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $doctor_model = new DoctorModel();
    for ($index = 0; $index < count($data); $index++) {
        $doctor = $data[$index];
        $doctor_id = $doctor["doctor_id"];
        $first_name = $doctor["first_name"];
        $last_name = $doctor["last_name"];
        $email = $doctor['email'];
        $phone = $doctor['phone'];
        $department_id = $doctor['department_id'];

        $new_doctor_records = array(
            "doctor_id" => $doctor_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone,
            "department_id" => $department_id
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $doctor_model->createDoctors($new_doctor_records);
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
 * Update one or multiple doctors
 * URI: /doctors
 */
function handleUpdateDoctors(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_OK;
    $data = $request->getParsedBody();

    $doctor_model = new DoctorModel();

    for ($index = 0; $index < count($data); $index++) {
        $doctor = $data[$index];
        $doctor_id = $doctor["doctor_id"];
        $first_name = $doctor["first_name"];
        $last_name = $doctor["last_name"];
        $email = $doctor['email'];
        $phone = $doctor['phone'];
        $department_id = $doctor['department_id'];

        $updated_doctor_records = [
            'data' => [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "phone" => $phone,
                "department_id" => $department_id,
            ],
            'where' => [
                "doctor_id" => $doctor_id
            ]
        ];

        $doctor_model->updateDoctors($updated_doctor_records);
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
 * Delete a record from the doctors table
 * URI: /doctors/{doctor_id}
 */
function handleDeleteDoctor(Request $request, Response $response, array $args) {
    $rowsCount = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $doctor_model = new DoctorModel();

    $doctor_id = $args["doctor_id"];

    if (isset($doctor_id)) {
        $rowsCount = $doctor_model->deleteDoctor($doctor_id);
        if (!$rowsCount) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified doctor.");
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

