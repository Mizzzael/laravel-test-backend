<?php

namespace App\Helpers;

class Responses {

  private static function formatJsonToResponse($status, $message, $response) 
  {
    return response(json_encode([
      "status" => $status,
      "response" => $response,
      "message" => $message
    ]),$status)->header('Content-Type', 'application/json');
  }

  /**
   * Response with status 200, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function success($message) {
    return self::formatJsonToResponse(200, "Accepted", $message);
  }

  /**
   * Response with status 409, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function conflict($message) {
    return self::formatJsonToResponse(409, "Conflict", $message);     
  }

  /**
   * Response with status 200, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function created($message) {
    return self::formatJsonToResponse(201, "Created", $message);    
  }

  /**
   * Response with status 404, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function notFound($message) {
    return self::formatJsonToResponse(404, "Not Found", $message);    
  }

}