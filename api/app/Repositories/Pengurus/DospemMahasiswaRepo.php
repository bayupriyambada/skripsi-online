<?php

namespace App\Repositories\Pengurus;

use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Http\Resources\Single\DataListMahaDosenResource;
use App\Models\DosenMahasiswaModel;
use App\Models\PanduanSkripsiModel;

class DospemMahasiswaRepo
{

  public function getList(){
    try {
      $data = DataListMahaDosenResource::collection(DosenMahasiswaModel::data()->get()->makeHidden(['diubah_pada', 'dihapus_pada']));
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getSave($params){
    try {
     /* This is a ternary operator. It is a shorthand way of writing an if/else statement. */
      $mahasiswaId = isset($params['mahasiswa_id']) ? $params['mahasiswa_id'] : '';
      if(strlen($mahasiswaId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Mahasiswa '.ConstantaHelpers::GET_NOTFOUND);
      }
      $dospemId = isset($params['dospem_id']) ? $params['dospem_id'] : '';
      if(strlen($dospemId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Dospem '.ConstantaHelpers::GET_NOTFOUND);
      }
      
      $dospemMahasiswaId = isset($params['dospem_mahasiswa_id']) ? $params['dospem_mahasiswa_id'] : '';
      if(strlen($dospemMahasiswaId) == 0){
        $data = new DosenMahasiswaModel();
        $data->dibuat_pada = FormatHelpers::IndonesiaFormatData();
      }else{
        $data = DosenMahasiswaModel::find($dospemMahasiswaId);
        $data->diubah_pada = FormatHelpers::IndonesiaFormatData();
        if(is_null($data)){
          return ResponseHelpers::validateResponse404
          (404, ConstantaHelpers::GET_DATA_NOTFOUND);
        }
        if(!is_null($data->dihapus_pada)){
          return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
        }
      }
      $data->mahasiswa_id = $mahasiswaId;
      $data->dospem_id = $dospemId;
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getDelete($params){
    try {
     
      $panduanSkripsiId = isset($params['panduan_skripsi_id']) ? $params['panduan_skripsi_id'] : '';
      if(strlen($panduanSkripsiId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Gelombang '.ConstantaHelpers::GET_NOTFOUND);
      }
      $data = PanduanSkripsiModel::query()->find($panduanSkripsiId);
      
      if(is_null($data)){
        return ResponseHelpers::validateResponse404
        (404, ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      if(!is_null($data->dihapus_pada)){
        return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
      }
      $data->dihapus_pada = FormatHelpers::IndonesiaFormatData();
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DELETE . ' ' . $data->gelombang , []);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
