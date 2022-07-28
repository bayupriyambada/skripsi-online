<?php

namespace App\Repositories\Mahasiswa;

use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Models\PengajuanSkripsiModel;

class PengajuanSkripsiRepo
{

  public function getList(){
    try {
      $data = PengajuanSkripsiModel::data()->where('mahasiswa_id', auth()->guard('api_mahasiswa')->user()->mahasiswa_id)->get();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getSave($params){
    try {
     /* This is a ternary operator. It is a shorthand way of writing an if/else statement. */
      $pengajuanSkripsi = isset($params['nama_pengajuan_skripsi']) ? $params['nama_pengajuan_skripsi'] : '';
      if(strlen($pengajuanSkripsi) == 0){
        return ResponseHelpers::validateResponse404(404, 'Pengajuan Skripsi '.ConstantaHelpers::GET_NOTFOUND);
      }
      $descriptionSkripsi = isset($params['deskripsi_pengajuan_skripsi']) ? $params['deskripsi_pengajuan_skripsi'] : '';
      if(strlen($descriptionSkripsi) == 0){
        return ResponseHelpers::validateResponse404(404, 'Description Skripsi Pengajuan '.ConstantaHelpers::GET_NOTFOUND);
      }
      $pengajuanSkripsiId = isset($params['pengajuan_skripsi_id']) ? $params['pengajuan_skripsi_id'] : '';
      if(strlen($pengajuanSkripsiId) == 0){
        $data = new PengajuanSkripsiModel();
        $data->dibuat_pada = FormatHelpers::IndonesiaFormatData();
        $data->mahasiswa_id = auth()->guard('api_mahasiswa')->user()->mahasiswa_id;
      }else{
        $data = PengajuanSkripsiModel::find($pengajuanSkripsiId);
        $data->diubah_pada = FormatHelpers::IndonesiaFormatData();
        $data->mahasiswa_id = auth()->guard('api_mahasiswa')->user()->mahasiswa_id;
        if(is_null($data)){
          return ResponseHelpers::validateResponse404
          (404, ConstantaHelpers::GET_DATA_NOTFOUND);
        }
        if(!is_null($data->dihapus_pada)){
          return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
        }
      }
      $data->nama_pengajuan_skripsi = $pengajuanSkripsi;
      $data->deskripsi_pengajuan_skripsi = $descriptionSkripsi;
      $data->telah_disetujui_kaprodi = 0;
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE . ' ' . $data->nama_pengajuan_skripsi ,
      $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
  public function getDelete($params){
    try {
     
      $pengajuanSkripsiId = isset($params['pengajuan_skripsi_id']) ? $params['pengajuan_skripsi_id'] : '';
      if(strlen($pengajuanSkripsiId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Pengajuan Skripsi '.ConstantaHelpers::GET_NOTFOUND);
      }
      $data = PengajuanSkripsiModel::query()->find($pengajuanSkripsiId);
      
      if(is_null($data)){
        return ResponseHelpers::validateResponse404
        (404, ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      if(!is_null($data->dihapus_pada)){
        return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
      }
      
      if($data->telah_disetujui_kaprodi == 3){
        return ResponseHelpers::validateResponse404(201, 'Thesis submission cannot be deleted because it has been approved');
      }
      $data->dihapus_pada = FormatHelpers::IndonesiaFormatData();
      $data->save();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DELETE . ' ' . $data->nama_fakultas , []);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
