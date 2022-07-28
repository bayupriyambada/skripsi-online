<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Repositories\Pengurus\DataListDosenMahasiswaRepo;

class DataListMahasiswaDospemController extends Controller{
  public DataListDosenMahasiswaRepo $query;
  public function __construct()
  {
    $this->query = new DataListDosenMahasiswaRepo();
  }

  public function getDospem(){
    $data = $this->query->getDospem();
    return $data;
  }
  public function getMahasiswa(){
    $data = $this->query->getMahasiswa();
    return $data;
  }
}
