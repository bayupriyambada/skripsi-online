<?php

namespace App\Http\Controllers\Kaprodi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Kaprodi\PengajuanSkripsiAllRepo;

class PengajuanSkripsiController extends Controller{
  public PengajuanSkripsiAllRepo $query;
  public function __construct()
  {
    $this->query = new PengajuanSkripsiAllRepo();
  }

  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
}
