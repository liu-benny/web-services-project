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

}

/**
 * Update one or multiple schedules
 * URI: /schedules
 */
function handleUpdateSchedules(Request $request, Response $response, array $args) {

}

/**
 * Delete a schedule record from the `days_of_week` table
 * URI: /schedules/{schedule_id}
 */
function handleDeleteSchedules(Request $request, Response $response, array $args) {

}

