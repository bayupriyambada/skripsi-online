<?php

namespace App\Helpers;

class ResponseHelpers{
  
  /**
   * It returns a JSON response with a code, message, and data.
   * 
   * @param code The HTTP status code you want to return.
   * @param message The message you want to display to the user.
   * @param data The data you want to return.
   * 
   * @return A JSON response.
   */
  public static function successJson($code = 200 , $message , $data){
    return response()->json([
      'code' => $code,
      'message' => $message,
      'data' => $data
    ]);
  }
 /**
  * It returns a JSON response with a code and message.
  * 
  * @param code The HTTP status code you want to return.
  * @param message The message you want to display to the user.
  * 
  * @return A JSON response with a code and message.
  */
  public static function errorCatch($code = 400 , $message){
    return response()->json([
      'code' => $code,
      'message' => $message,
    ]);
  }
  /**
   * It returns a json response with a code, message, and user.
   * 
   * @param code The HTTP status code you want to return.
   * @param message The message you want to display to the user.
   * @param user The user object that you want to return.
   * 
   * @return A JSON response with a code, message, and user.
   */
  public static function loginJsonJwt($success , $message , $user , $token){
    return response()->json([
      'success' => $success,
      'message' => $message,
      'user' => $user,
      'token' => $token,
    ]);
  }
  /**
   * It returns a JSON response with a 404 status code and a message.
   * 
   * @param code The HTTP status code you want to return.
   * @param message The message you want to display to the user.
   * 
   * @return A JSON response with a 404 code and a message.
   */
  public static function validateResponse404($code , $message){
    return response()->json([
      'code' => $code,
      'message' => $message,
    ]);
  }
  public static function succesGetUsersJwt($code , $message, $user){
    return response()->json([
      'code' => $code,
      'message' => $message,
      'user' => $user
    ]);
  }
  public static function logoutJsonJwt($success , $message){
    return response()->json([
      'success' => $success,
      'message' => $message,
    ]);
  }
}
