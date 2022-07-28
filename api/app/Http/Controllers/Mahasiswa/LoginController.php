<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Mahasiswa\LoginRepo;

class LoginController extends Controller{
  public LoginRepo $log;
  public function __construct()
  {
    $this->log = new LoginRepo();
  }

  public function getRegister(Request $req){
    $data = [
      'email' => $req->input('email'),
      'password' => $req->input('password'),
      'username' => $req->input('username'),
      'jenis_kelamin' => $req->input('jenis_kelamin'),
      'fakultas_id' => $req->input('fakultas_id'),
      'nimn' => $req->input('nimn'),
      'password' => $req->input('password'),
    ];
    $data = $this->log->getRegister($req);
    return $data;
  }
  public function getLogin(Request $req){
    $data = [
      'nimn' => $req->input('nimn'),
      'password' => $req->input('password'),
    ];
    $data = $this->log->getLogin($req);
    return $data;
  }
  public function getUsers(){
    $data = $this->log->getUsers();
    return $data;
  }
  public function getRefreshToken(Request $req){
    $data = $this->log->getRefreshToken($req);
    return $data;
  }
  public function getLogout(){
    $data = $this->log->getLogout();
    return $data;
  }
}
