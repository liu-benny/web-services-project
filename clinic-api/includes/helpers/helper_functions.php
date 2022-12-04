<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

function getErrorUnsupportedFormat() {
    $error_data = array(
        "error:" => "unsuportedResponseFormat",
        "message:" => "The requested resouce representation is available only in JSON."
    );
    return $error_data;
}


function makeCustomJSONError($error_code, $error_message) {
    $error_data = array(
        "error:" => $error_code,
        "message:" => $error_message
    );    
    return json_encode($error_data);
}

function makeCustomJSONMessage($title, $message) {
    $data = array(
        "title:" => $title,
        "message:" => $message
    );    
    return json_encode($data);
}

function handleUnsupportedOperation(Request $request, Response $response, $args){

    $error_data = array();
    $error_data["error"] = "UnsupportedOperation";
    $error_data["message"] = "The operation you requested on the specified resource with " . $request->getUri();
    $error_data["message"] .= " HTTP Method " . $request->getMethod();

     $response->getBody()->write(json_encode($error_data));
     return $response->withStatus(405);
}