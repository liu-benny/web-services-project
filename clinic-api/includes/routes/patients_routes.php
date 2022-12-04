<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/PatientModel.php';

/**
 * Retrieve a patient from the `patient` table.
 * URI: /patients/{patient_id}
 * Filtering options: first_name, last_name, gender
 */
function handleGetPatientById(Request $request, Response $response, array $args) {
    $patient = array();
    $response_data = array();
    $response_code = HTTP_OK;

    $patient_model = new PatientModel();

    $patient_id = $args['patient_id'];

    if (isset($patient_id)) {
        $patient = $patient_model->getPatientById($patient_id);
        if (!$patient) {
            $response_data = makeCustomJSONError("resourceNotFound", "No record was found for the specified patient.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    $requested_format = $request->getHeader('Accept');

    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($patient, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Retrieve all patients from the `patient` table.
 * URI: /patients
 */
function handleGetAllPatients(Request $request, Response $response, array $args) {
    $patients = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $patient_model = new PatientModel();

    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);

    // Set default values if one of the following was invalid.
    $page_number = ($input_page_number > 0) ? $input_page_number : 1;
    $per_page = ($input_per_page > 0) ? $input_per_page : 10;

    // Set the pagination options.
    $patient_model->setPaginationOptions($page_number, $per_page);

    // Retreive the query string parameter from the request's URI.
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["first_name"])) {
        // Fetch the list of artists matching the provided genre.
        $patients = $patient_model->getPatientsByFirstName($filter_params["first_name"]);
    }
    else if (isset($filter_params["last_name"])) {
        // Fetch the list of artists matching the provided mediaType.
        $patients = $patient_model->getPatientsByLastName($filter_params["last_name"]);
    }
    else if (isset($filter_params["gender"])) {
        // Fetch the list of artists matching the provided mediaType.
        $patients = $patient_model->getPatientsByGender($filter_params["gender"]);
    }
    else
        $patients = $patient_model->getAllPatients();

    if (!$patients) {
        $response_data = makeCustomJSONError("resourceNotFound", "No record was found.");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }
    
    $requested_format = $request->getHeader('Accept');
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($patients, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

/**
 * Create one or multiple patients
 * URI: /patients
 */
function handleCreatePatients(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $patient_model = new PatientModel();

    for ($index = 0; $index < count($data); $index++) {
        $patient = $data[$index];
        $patient_id = $patient["patient_id"];
        $first_name = $patient["first_name"];
        $last_name = $patient["last_name"];
        $email = $patient['email'];
        $phone = $patient['phone'];
        $date_of_birth = $patient['date_of_birth'];
        $gender = $patient['gender'];
        $password = $patient['password'];

        $new_patient_records = array(
            "patient_id" => $patient_id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone,
            "date_of_birth" => $date_of_birth,
            "gender" => $gender,
            "password" => $password
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $patient_model->createPatients($new_patient_records);
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
 * Update one or multiple patientss
 * URI: /patients
 */
function handleUpdatePatients(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_OK;
    $data = $request->getParsedBody();

    $patient_model = new PatientModel();

    for ($index = 0; $index < count($data); $index++) {
        $patient = $data[$index];
        $patient_id = $patient["patient_id"];
        $first_name = $patient["first_name"];
        $last_name = $patient["last_name"];
        $email = $patient['email'];
        $phone = $patient['phone'];
        $date_of_birth = $patient['date_of_birth'];
        $gender = $patient['gender'];
        $password = $patient['password'];

        $updated_patient_records = [
            'data' => [
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "phone" => $phone,
                "date_of_birth" => $date_of_birth,
                "gender" => $gender,
                "password" => $password
            ],
            'where' => [
                "patient_id" => $patient_id,
            ]
        ];

        $patient_model->updatePatients($updated_patient_records);
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
 * Delete a record from the patients table
 * URI: /patients/{patient_id}
 */
function handleDeletePatient(Request $request, Response $response, array $args) {
    $rowsCount = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $patient_model = new PatientModel();

    // Retreive the artist if from the request's URI.
    $patient_id = $args["patient_id"];

    if (isset($patient_id)) {
        // Fetch the info about the specified artist.
        $rowsCount = $patient_model->deletePatient($patient_id);
        if (!$rowsCount) {
            // No matches found?
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified patient.");
            $response->getBody()->write($response_data);
            return $response->withStatus(HTTP_NOT_FOUND);
        }
    }
    // Handle serve-side content negotiation and produce the requested representation.    
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

