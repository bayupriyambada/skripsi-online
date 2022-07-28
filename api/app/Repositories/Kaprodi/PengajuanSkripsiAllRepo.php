<?php

namespace App\Repositories\Kaprodi;

use App\Models\FakultasModel;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Models\PengajuanSkripsiModel;

class PengajuanSkripsiAllRepo
{

  public function getList(){
    try {
      $data = PengajuanSkripsiModel::data()->get();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
