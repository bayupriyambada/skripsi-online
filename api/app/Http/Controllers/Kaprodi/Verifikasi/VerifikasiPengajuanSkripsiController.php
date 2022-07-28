<?php

namespace App\Http\Controllers\Kaprodi\Verifikasi;

use App\Http\Controllers\Controller;
use App\Repositories\Kaprodi\Verifikasi\VerifikasiPengajuanSkripsiRepo;
use Illuminate\Http\Request;

class VerifikasiPengajuanSkripsiController extends Controller{
  public VerifikasiPengajuanSkripsiRepo $query;
  public function __construct()
  {
    $this->query = new VerifikasiPengajuanSkripsiRepo();
  }
  
  public function getVerifikasiPengajuan($pengajuanSkrispiId, Request $request){
    $data = [
      'pengajuan_skripsi_id'=>$pengajuanSkrispiId,
      'jawaban_status_pengajuan'=> $request->input('jawaban_status_pengajuan'),
      'telah_disetujui_kaprodi'=> $request->input('telah_disetujui_kaprodi'),
    ];
    $data = $this->query->getVerifikasiPengajuan($request);
    return $data;
  }
}
