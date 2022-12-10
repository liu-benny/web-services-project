<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Display an error message when the requested resource representation is not available.
 * 
 * @return array
 */
function getErrorUnsupportedFormat() {
    $error_data = array(
        "error:" => "unsuportedResponseFormat",
        "message:" => "The requested resouce representation is available only in JSON."
    );
    return $error_data;
}

/**
 * Display a custom JSON error.
 * @param string $error_code
 * @param string $error_message
 * @return string
 */
function makeCustomJSONError($error_code, $error_message) {
    $error_data = array(
        "error:" => $error_code,
        "message:" => $error_message
    );    
    return json_encode($error_data);
}

/**
 * Display a custom JSON message.
 * @param string $title
 * @param string $message
 * @return string
 */
function makeCustomJSONMessage($title, $message) {
    $data = array(
        "title:" => $title,
        "message:" => $message
    );    
    return json_encode($data);
}

/**
 * Display an error message when the requested operation is not supported.
 * @param Request $request
 * @param Response $response
 * @param array $args
 * @return Response
 */
function handleUnsupportedOperation(Request $request, Response $response, $args){

    $error_data = array();
    $error_data["error"] = "UnsupportedOperation";
    $error_data["message"] = "The operation you requested on the specified resource with " . $request->getUri();
    $error_data["message"] .= " HTTP Method " . $request->getMethod();

     $response->getBody()->write(json_encode($error_data));
     return $response->withStatus(405);
}