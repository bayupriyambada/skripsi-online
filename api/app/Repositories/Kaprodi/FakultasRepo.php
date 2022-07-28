<?php

namespace App\Repositories\Kaprodi;

use App\Models\FakultasModel;
use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;

class FakultasRepo
{

  public function getList(){
    try {
      $data = FakultasModel::data()->get();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getSave($params){
    try {
     /* This is a ternary operator. It is a shorthand way of writing an if/else statement. */
      $singkatFakultas = isset($params['singkat']) ? $params['singkat'] : '';
      if(strlen($singkatFakultas) == 0){
        return ResponseHelpers::validateResponse404(404, 'Singkatan Fakultas '.ConstantaHelpers::GET_NOTFOUND);
      }
      $namaFakultas = isset($params['nama_fakultas']) ? $params['nama_fakultas'] : '';
      if(strlen($namaFakultas) == 0){
        return ResponseHelpers::validateResponse404(404, 'Nama Fakultas '.ConstantaHelpers::GET_NOTFOUND);
      }
      $fakultasId = isset($params['fakultas_id']) ? $params['fakultas_id'] : '';
      if(strlen($fakultasId) == 0){
        $data = new FakultasModel();
        $data->dibuat_pada = FormatHelpers::IndonesiaFormatData();
      }else{
        $data = FakultasModel::find($fakultasId);
        $data->diubah_pada = FormatHelpers::IndonesiaFormatData();
        if(is_null($data)){
          return ResponseHelpers::validateResponse404
          (404, ConstantaHelpers::GET_DATA_NOTFOUND);
        }
        if(!is_null($data->dihapus_pada)){
          return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
        }
      }
      $data->singkat = $singkatFakultas;
      $data->nama_fakultas = $namaFakultas;
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE . ' ' . $data->nama_fakultas , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getDelete($params){
    try {
     
      $fakultasId = isset($params['fakultas_id']) ? $params['fakultas_id'] : '';
      if(strlen($fakultasId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Fakultas '.ConstantaHelpers::GET_NOTFOUND);
      }
      $data = FakultasModel::query()->find($fakultasId);
      
      if(is_null($data)){
        return ResponseHelpers::validateResponse404
        (404, ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      if(!is_null($data->dihapus_pada)){
        return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
      }
      $data->dihapus_pada = FormatHelpers::IndonesiaFormatData();
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DELETE . ' ' . $data->nama_fakultas , []);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
