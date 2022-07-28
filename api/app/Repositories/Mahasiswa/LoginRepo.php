<?php

namespace App\Repositories\Mahasiswa;

use App\Models\Mahasiswa;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginRepo
{

  public function getRegister($params)
  {
    try {
      /* It's checking if the email and password is empty or not. */
      $nimn = isset($params['nimn']) ? $params['nimn'] : '';
      if (strlen($nimn) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Nimn ' . ConstantaHelpers::GET_VALIDATE);
      }
      $username = isset($params['username']) ? $params['username'] : '';
      if (strlen($username) == 0) {
      return ResponseHelpers::validateResponse404(404, 'Username ' . ConstantaHelpers::GET_VALIDATE);
      }
      $email = isset($params['email']) ? $params['email'] : '';
      if (strlen($email) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Email ' . ConstantaHelpers::GET_VALIDATE);
      }
      $password = isset($params['password']) ? $params['password'] : '';
      if (strlen($password) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Password ' . ConstantaHelpers::GET_VALIDATE);
      }
      
      $jenisKelamin = isset($params['jenis_kelamin']) ? $params['jenis_kelamin'] : '';
      if (strlen($jenisKelamin) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Gender ' . ConstantaHelpers::GET_VALIDATE);
      }
      $fakultasId = isset($params['fakultas_id']) ? $params['fakultas_id'] : '';
      if (strlen($fakultasId) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Fakultas ' . ConstantaHelpers::GET_VALIDATE);
      }

      $data = new Mahasiswa();
      $data->email = $email;
      $data->password = Hash::make($password);
      $data->username = $username;
      $data->jenis_kelamin = $jenisKelamin;
      $data->nimn = $nimn;
      $data->fakultas_id = $fakultasId;
      $data->save();

      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE, $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getLogin($params)
  {
    try {
      /* It's checking if the email and password is empty or not. */
      $nimn = isset($params['nimn']) ? $params['nimn'] : '';
      if (strlen($nimn) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Nimn ' . ConstantaHelpers::GET_VALIDATE);
      }
      $password = isset($params['password']) ? $params['password'] : '';
      if (strlen($password) == 0) {
        return ResponseHelpers::validateResponse404(404, 'Password ' . ConstantaHelpers::GET_VALIDATE);
      }
      
      
      /* It's checking if the email and password is empty or not. */
      $credentials = $params->only('nimn', 'password');
      if (
        !($token = auth()
          ->guard('api_mahasiswa')
          ->attempt($credentials))
      ) {
        return response()->json(
        [
          'success' => false,
          'message' => 'Nimn or Password is incorrect',
          ],
          401
        );
      }
      /* It's returning the response with the status code, message, data, and token. */
      return ResponseHelpers::loginJsonJwt(
        true,
        ConstantaHelpers::GET_SUCCESS_LOGIN,
        auth()->guard('api_mahasiswa')->user(),
        $token,
      );
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }

  public function getUsers()
  {
    try {
      $data= Mahasiswa::query()->where('mahasiswa_id',
      auth()->guard('api_mahasiswa')->user()->mahasiswa_id)->with('getFakultas')->first();
      return ResponseHelpers::succesGetUsersJwt(
        200,
        ConstantaHelpers::GET_DATA_USER,
        $data
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
      // auth()->logout(true);
      return ResponseHelpers::logoutJsonJwt(true, ConstantaHelpers::GET_SUCCESS_LOGOUT);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
