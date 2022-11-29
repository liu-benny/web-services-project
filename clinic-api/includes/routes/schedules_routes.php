<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ScheduleModel.php';

/**
 * Retrieve all schedules from the `schedule` table join with `days_of_week` table.
 * URI: /schedules
 */
function handleGetAllSchedules(Request $request, Response $response, array $args) {
    $schedules = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $schedule_model = new ScheduleModel();


    $schedules = $schedule_model->getAllSChedules();
    if (!$schedules) {
        $response_data = makeCustomJSONError("resourceNotFound", "No record was found.");
        $response->getBody()->write($response_data);
        return $response->withStatus(HTTP_NOT_FOUND);
    }
    
    $requested_format = $request->getHeader('Accept');
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($schedules, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}


/**
 * Create one or multiple schedules
 * URI: /schedules
 */
function handleCreateSchedules(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $schedule_model = new ScheduleModel();

    for ($index = 0; $index < count($data); $index++) {
        $schedule = $data[$index];
        $schedule_id = $schedule["schedule_id"];
        $is_available = $schedule["is_available"];
        $doctor_id = $schedule["doctor_id"];

        $new_schedule_records = array(
            "schedule_id" => $schedule_id,
            "is_available" => $is_available,
            "doctor_id" => $doctor_id
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $schedule_model->createSchedules($new_schedule_records);
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
 * Update one or multiple schedules
 * URI: /schedules
 */
function handleUpdateSchedules(Request $request, Response $response, array $args) {
    $response_data = array();
    $response_code = HTTP_OK;
    $data = $request->getParsedBody();

    $schedule_model = new ScheduleModel();

    for ($index = 0; $index < count($data); $index++) {
        $schedule = $data[$index];
        $schedule_id = $schedule["schedule_id"];
        $is_available = $schedule["is_available"];
        $doctor_id = $schedule["doctor_id"];

        $new_schedule_records = array(
            'data' => [
                "is_available" => $is_available,
                "doctor_id" => $doctor_id
            ],
            'where' => [
                "schedule_id" => $schedule_id
            ]
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $schedule_model->updateSchedules($new_schedule_records);
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
 * Delete a schedule record from the `days_of_week` table
 * URI: /schedules/{schedule_id}
 */
function handleDeleteSchedule(Request $request, Response $response, array $args) {
    $rowsCount = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $schedule_model = new ScheduleModel();

    $schedule_id = $args["schedule_id"];

    if (isset($schedule_id)) {
        $rowsCount = $schedule_model->deleteSchedule($schedule_id);
        if (!$rowsCount) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified schedule.");
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

