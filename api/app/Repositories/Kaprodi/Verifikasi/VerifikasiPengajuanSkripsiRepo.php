<?php

namespace App\Repositories\Kaprodi\Verifikasi;

use Notification;
use Illuminate\Support\Str;
use App\Helpers\FormatHelpers;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Models\PengajuanSkripsiModel;
use App\Notifications\SkripsiNotification;
use Illuminate\Support\Facades\Notification as Notif;
use App\Models\Notifications\NotificationPengajuanModel;

class VerifikasiPengajuanSkripsiRepo
{

  public function getVerifikasiPengajuan($params){
    try {
    
      $pengajuanSkripsiId = isset($params['pengajuan_skripsi_id']) ? $params['pengajuan_skripsi_id'] : '';
      if(strlen($pengajuanSkripsiId) == 0){
        return ResponseHelpers::validateResponse404(404, 'Pengajuan Skripsi ' .ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      $answerPengajuanSkripsi = isset($params['jawaban_status_pengajuan']) ? $params['jawaban_status_pengajuan'] : '';
      if(strlen($answerPengajuanSkripsi) == 0){
        return ResponseHelpers::validateResponse404(404, 'Answer Pengajuan Skrpsi ' .ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      $telahDisetujuiKaprodi = isset($params['telah_disetujui_kaprodi']) ? $params['telah_disetujui_kaprodi'] : '';
      if(strlen($telahDisetujuiKaprodi) == 0){
        return ResponseHelpers::validateResponse404(404, 'Di setujui ' .ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      $data = PengajuanSkripsiModel::find($pengajuanSkripsiId);
      if(is_null($data)){
        return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DATA_NOTFOUND);
      }
      if(!is_null($data->dihapus_pada)){
        return ResponseHelpers::validateResponse404(404, ConstantaHelpers::GET_DELETE_TRASH);
      }
      $data->jawaban_status_pengajuan = $answerPengajuanSkripsi;
      $data->telah_disetujui_kaprodi = $telahDisetujuiKaprodi;
      if($data->save()){
        $pengajuanSkripsi = new NotificationPengajuanModel();
        $pengajuanSkripsi->notification_pengajuan_id = Str::uuid();
        $pengajuanSkripsi->pengajuan_skripsi_id = $data->pengajuan_skripsi_id;
        $pengajuanSkripsi->judul_pengajuan = $data->nama_pengajuan_skripsi;
        $pengajuanSkripsi->alasan = $data->jawaban_status_pengajuan;
        $pengajuanSkripsi->status_data_pengajuan = $data->telah_disetujui_kaprodi;
        $pengajuanSkripsi->mahasiswa_id = $data->mahasiswa_id;
        $pengajuanSkripsi->dikirim_pada = FormatHelpers::IndonesiaFormatData();
        $pengajuanSkripsi->save();
        return ResponseHelpers::successJson(200, ConstantaHelpers::GET_SAVE, $pengajuanSkripsi);
      }
      return ResponseHelpers::successJson(200, Str::ucfirst($data->nama_pengajuan_skripsi) .' '.ConstantaHelpers::GET_SAVE,
      $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }

}
