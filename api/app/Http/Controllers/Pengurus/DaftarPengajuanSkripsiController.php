<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Repositories\Pengurus\DaftarPengajuanSkripsiRepo;

class DaftarPengajuanSkripsiController extends Controller{
  public DaftarPengajuanSkripsiRepo $query;
  public function __construct()
  {
    $this->query = new DaftarPengajuanSkripsiRepo();
  }

  public function getDaftarPengajuanSkripsiAcc(){
    $data = $this->query->getDaftarPengajuanSkripsiAcc();
    return $data;
  }
}
