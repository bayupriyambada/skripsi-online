<?php

namespace App\Repositories\Kaprodi;

use App\Models\GelombangModel;
use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;

class GelombangRepo
{

  public function getList(){
    try {
      $data = GelombangModel::data()->get();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getSave($params){
    try {
     /* This is a ternary operator. It is a shorthand way of writing an if/else statement. */
      $gelombang = isset($params['gelombang']) ? $params['gelombang'] : '';
      if(strlen($gelombang) == 0){
        return ResponseHelpers::validateResponse404(404, 'Gelombang Skripsi '.ConstantaHelpers::GET_NOTFOUND);
      }
      $dateStart = isset($params['date_mulai']) ? $params['date_mulai'] : '';
      if(strlen($dateStart) == 0){
        return ResponseHelpers::validateResponse404(404, 'Date Start Gelombang '.ConstantaHelpers::GET_NOTFOUND);
      }
      $dateEnd = isset($params['date_selesai']) ? $params['date_selesai'] : '';
      if(strlen($dateEnd) == 0){
        return ResponseHelpers::validateResponse404(404, 'Date End Gelombang '.ConstantaHelpers::GET_NOTFOUND);
      }
      $gelombangStatus = isset($params['gelombang_status']) ? $params['gelombang_status'] : '';
      if(strlen($gelombangStatus) == 0){
        return ResponseHelpers::validateResponse404(404, 'Gelombang Status '.ConstantaHelpers::GET_NOTFOUND);
      }
      $gelombangId = isset($params['gelombang_skripsi_id']) ? $params['gelombang_skripsi_id'] : '';
      if(strlen($gelombangId) == 0){
        $data = new GelombangModel();
        $data->dibuat_pada = FormatHelpers::IndonesiaFormatData();
      }else{
        $data = GelombangModel::find($gelombangId);
        $data->diubah_pada = FormatHelpers::IndonesiaFormatData();
        if(is_null($data)){
          return ResponseHelpers::validateResponse404
          (404, ConstantaHelpers::GET_DATA_NOTFOUND);
        }
        if(!is_null($data->dihapus_pada)){
          return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
        }
      }
      $data->gelombang = $gelombang;
      $data->date_mulai = $dateStart;
      $data->date_selesai = $dateEnd;
      $data->gelombang_status = $gelombangStatus;
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE . ' ' . $data->gelombang , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getDelete($params){
    try {
     
      $gelombangId = isset($params['gelombang_skripsi_id']) ? $params['gelombang_skripsi_id'] : '';
      if(strlen($gelombangId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Gelombang '.ConstantaHelpers::GET_NOTFOUND);
      }
      $data = GelombangModel::query()->find($gelombangId);
      
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
