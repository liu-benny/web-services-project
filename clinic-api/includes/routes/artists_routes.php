<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . './../models/BaseModel.php';
require_once __DIR__ . './../models/ArtistModel.php';
require_once __DIR__ . './../models/WSLoggingModel.php';

function handleCreateArtists(Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $html = var_export($data, true);
    $response->getBody()->write($html);
    return $response;
}

// Callback for HTTP GET /artists
//-- Supported filtering operation: by artist name.
function handleGetAllArtists(Request $request, Response $response, array $args) {
    $artists = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();
    //----------------------------------------    
    $logging_model = new WSLoggingModel();
    //-- Get the decode JWT payload section. 
    $decoded_jwt = $request->getAttribute('decoded_token_data');
    $logging_model->logUserAction($decoded_jwt, "getListOfArtists");
    //--------------------------------------   
    // Retreive the query string parameter from the request's URI.
    $filter_params = $request->getQueryParams();
    if (isset($filter_params["name"])) {
        // Fetch the list of artists matching the provided name.
        $artists = $artist_model->getWhereLike($filter_params["name"]);
    } else {
        // No filtering by artist name detected.
        $artists = $artist_model->getAll();
    }
    // Handle serve-side content negotiation and produce the requested representation.    
    $requested_format = $request->getHeader('Accept');
    //--
    //-- We verify the requested resource representation.    
    if ($requested_format[0] === APP_MEDIA_TYPE_JSON) {
        $response_data = json_encode($artists, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}

function handleGetArtistById(Request $request, Response $response, array $args) {
    $artist_info = array();
    $response_data = array();
    $response_code = HTTP_OK;
    $artist_model = new ArtistModel();

    // Retreive the artist if from the request's URI.
    $artist_id = $args["artist_id"];
    if (isset($artist_id)) {
        // Fetch the info about the specified artist.
        $artist_info = $artist_model->getArtistById($artist_id);
        if (!$artist_info) {
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
        $response_data = json_encode($artist_info, JSON_INVALID_UTF8_SUBSTITUTE);
    } else {
        $response_data = json_encode(getErrorUnsupportedFormat());
        $response_code = HTTP_UNSUPPORTED_MEDIA_TYPE;
    }
    $response->getBody()->write($response_data);
    return $response->withStatus($response_code);
}
