<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/AppointmentModel.php';

// Callback for HTTP GET /clinics/{clinic_id}/appointments
function handleGetAllAppointmentsByClinicId(Request $request, Response $response, array $args){
    $appointments = array();
    $response_data = array();
    $response_code = HTTP_OK;

    $appointment_model = new AppointmentModel();

    $clinic_id = $args['clinic_id'];

    if (isset($clinic_id)) {
        $appointments = $appointment_model->getAllAppointmentsByClinicId($clinic_id);
        if (!$appointments) {
            $response_data = makeCustomJSONError("resourceNotFound", "No matching record was found for the specified clinic.");
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

?>