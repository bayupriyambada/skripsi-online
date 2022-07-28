<?php

namespace App\Repositories\Pengurus;

use App\Models\PanduanSkripsiModel;
use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;

class PanduanSkripsiRepo
{

  public function getList(){
    try {
      $data = PanduanSkripsiModel::data()->get()->makeHidden(['dihapus_pada' , 'diubah_pada']);
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getSave($params){
    try {
     /* This is a ternary operator. It is a shorthand way of writing an if/else statement. */
      $keterangan = isset($params['keterangan']) ? $params['keterangan'] : '';
      if(strlen($keterangan) == 0){
        return ResponseHelpers::validateResponse404(404, 'Panduan Skripsi '.ConstantaHelpers::GET_NOTFOUND);
      }
      
      $panduanSkripsiId = isset($params['panduan_skripsi_id']) ? $params['panduan_skripsi_id'] : '';
      if(strlen($panduanSkripsiId) == 0){
        $data = new PanduanSkripsiModel();
        $data->dibuat_pada = FormatHelpers::IndonesiaFormatData();
      }else{
        $data = PanduanSkripsiModel::find($panduanSkripsiId);
        $data->diubah_pada = FormatHelpers::IndonesiaFormatData();
        if(is_null($data)){
          return ResponseHelpers::validateResponse404
          (404, ConstantaHelpers::GET_DATA_NOTFOUND);
        }
        if(!is_null($data->dihapus_pada)){
          return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
        }
      }
      $data->keterangan = $keterangan;
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
