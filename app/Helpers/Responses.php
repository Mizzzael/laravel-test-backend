<?php

namespace App\Helpers;

class Responses {

  /**
   * Response with status 200, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function success($message) {
    return response(json_encode([
      "status" => "200",
      "response" => $message,
      "message" => "Accepted"
    ]),200)->header('Content-Type', 'application/json');    
  }

  /**
   * Response with status 409, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function conflict($message) {
    return response(json_encode([
      "status" => "409",
      "response" => $message,
      "message" => "Conflict"
    ]), 409)->header('Content-Type', 'application/json');    
  }

  /**
   * Response with status 200, with a format;
   * 
   * @param $message Array
   * @return response 
   */
  static function created($message) {
    return response(json_encode([
      "status" => "201",
      "response" => $message,
      "message" => "Created"
    ]),201)->header('Content-Type', 'application/json');    
  }

}