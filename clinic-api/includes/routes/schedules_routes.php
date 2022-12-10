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
function handleGetAllSchedules(Request $request, Response $response, array $args)
{

    $input_page_number = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
    $input_per_page = filter_input(INPUT_GET, "per_page", FILTER_VALIDATE_INT);
    // Set default values if one of the following was invalid.
    $page_number = ($input_page_number > 0) ? $input_page_number : 1;
    $per_page = ($input_per_page > 0) ? $input_per_page : 10;

    $schedules = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $schedule_model = new ScheduleModel();

    $schedule_model->setPaginationOptions($page_number, $per_page);

    // Retreive the query string parameter from the request's URI.
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["day_of_week"])) {
        // Fetch the list of schedules matching the provided day of week
        $schedules = $schedule_model->getSChedulesByDayOfWeek($filter_params["day_of_week"]);
    }
    else {
        // No filtering by date detected.
        $schedules = $schedule_model->getAllSChedules();
    }
    // No matches found?
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
function handleCreateSchedules(Request $request, Response $response, array $args)
{
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $schedule_model = new ScheduleModel();
    //-- Go over elements stored in the $data array
    //-- In a for/each loop
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
function handleUpdateSchedules(Request $request, Response $response, array $args)
{
    $response_data = array();
    $response_code = HTTP_OK;
    $data = $request->getParsedBody();

    $schedule_model = new ScheduleModel();
    //-- Go over elements stored in the $data array
    //-- In a for/each loop
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
    // Handle serve-side content negotiation and produce the requested representation.    
    $requested_format = $request->getHeader('Accept');
    //--
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
 * Delete a schedule record from the `days_of_week` table
 * URI: /schedules/{schedule_id}
 */
function handleDeleteSchedule(Request $request, Response $response, array $args)
{
    $rowsCount = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $schedule_model = new ScheduleModel();
    // Retreive the doctor id from the request's URI.
    $schedule_id = $args["schedule_id"];

    if (isset($schedule_id)) {
        $rowsCount = $schedule_model->deleteSchedule($schedule_id);
        if (!$rowsCount) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified schedule.");
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

/**
 * Create day_of_week records for one or more schedules
 * URI: /schedules/days_of_week
 */
function handleCreateSChedulesDetails(Request $request, Response $response, array $args)
{
    $response_data = array();
    $response_code = HTTP_CREATED;
    $data = $request->getParsedBody();

    $schedule_model = new ScheduleModel();
    //-- Go over elements stored in the $data array
    //-- In a for/each loop
    for ($index = 0; $index < count($data); $index++) {
        $schedule = $data[$index];
        $schedule_id = $schedule["schedule_id"];
        $day_of_week = $schedule["day_of_week"];
        $time_from = $schedule["time_from"];
        $time_to = $schedule["time_to"];

        $new_schedule_details_records = array(
            "schedule_id" => $schedule_id,
            "day_of_week" => $day_of_week,
            "time_from" => $time_from,
            "time_to" => $time_to
        );

        //-- We retrieve the key and its value
        //-- We perform an UPDATE/CREATE SQL statement
        $schedule_model->createScheduleDetails($new_schedule_details_records);
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
