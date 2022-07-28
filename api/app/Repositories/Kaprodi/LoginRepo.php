<?php

namespace App\Repositories\Kaprodi;

use App\Models\Kaprodi;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginRepo
{

  public function getLogin($params)
  {
    try {
      /* It's checking if the email and password is empty or not. */
      $email = isset($params['email']) ? $params['email'] : '';
      if (strlen($email) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Email ' . ConstantaHelpers::GET_VALIDATE);
      }
      $password = isset($params['password']) ? $params['password'] : '';
      if (strlen($password) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Password ' . ConstantaHelpers::GET_VALIDATE);
      }
      /* It's checking if the email and password is empty or not. */
      $credentials = $params->only('email', 'password');
      if (
        !($token = auth()
          ->guard('api_kaprodi')
          ->attempt($credentials))
      ) {
        return response()->json(
        [
          'success' => false,
          'message' => 'Email or Password is incorrect',
          ],
          401
        );
      }

      /* It's returning the response with the status code, message, data, and token. */
      return ResponseHelpers::loginJsonJwt(
        true,
        ConstantaHelpers::GET_SUCCESS_LOGIN,
        auth()->guard('api_kaprodi')->user(),
        $token,
      );
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }

  public function getUsers()
  {
    try {
      return ResponseHelpers::succesGetUsersJwt(
        200,
        ConstantaHelpers::GET_DATA_USER,
        auth()->guard('api_kaprodi')->user()
      );
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }

  public function getRefreshToken($params)
  {
    $refreshToken = JWTAuth::refresh(JWTAuth::getToken());
    $user = JWTAuth::setToken($refreshToken)->toUser();
    $params->headers->set('Authorization', 'Bearer ' . $refreshToken);
    return ResponseHelpers::loginJsonJwt(
      200,
      ConstantaHelpers::GET_SUCCESS_LOGIN,
      $user,
      $refreshToken,
    );
  }
  public function getLogout()
  {
    try {
      /* It's removing the token. */
      $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
      dd($removeToken);
      // auth()->logout(true);
      return ResponseHelpers::logoutJsonJwt(true, ConstantaHelpers::GET_SUCCESS_LOGOUT);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
