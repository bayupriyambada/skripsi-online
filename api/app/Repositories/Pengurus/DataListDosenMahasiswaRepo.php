<?php

namespace App\Repositories\Pengurus;

use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Http\Resources\Single\DosenListResource;
use App\Http\Resources\Single\MahasiswaListResource;
use App\Models\Dospem;
use App\Models\Mahasiswa;

class DataListDosenMahasiswaRepo
{

  public function getDospem(){
    try {
      $data = DosenListResource::collection(Dospem::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']));
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getMahasiswa(){
    try {
      $data = MahasiswaListResource::collection(Mahasiswa::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']));
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
