<?php

namespace App\Repositories\Publik;

use App\Models\FakultasModel;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Models\GelombangModel;
use App\Models\PanduanSkripsiModel;

class DataPublikRepo
{

  public function getFakultas(){
    try {
      $data = FakultasModel::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']);
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getGelombang(){
    try {
      $data = GelombangModel::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']);
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getPanduan(){
    try {
      $data = PanduanSkripsiModel::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']);
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
