<?php

namespace App\Repositories\Pengurus;

use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Http\Resources\PengajuanSkripsiResource;
use App\Models\PengajuanSkripsiModel;

class DaftarPengajuanSkripsiRepo
{

  public function getDaftarPengajuanSkripsiAcc(){
    try {
      // $data = PengajuanSkripsiModel::data()->where('telah_disetujui_kaprodi' , 3)->get()->makeHidden(['diubah_pada', 'dihapus_pada']);
      $data = PengajuanSkripsiResource::collection(PengajuanSkripsiModel::data()->where('telah_disetujui_kaprodi' ,
      3)->get()->makeHidden(['diubah_pada', 'dihapus_pada']));
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
