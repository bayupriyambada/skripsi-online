<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Mahasiswa\PengajuanSkripsiRepo;

class PengajuanSkripsiController extends Controller{
  public PengajuanSkripsiRepo $query;
  public function __construct()
  {
    $this->query = new PengajuanSkripsiRepo();
  }
  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
  public function getSave(Request $request){
    $data = [
      'pengajuan_skripsi_id'=> $request->input('pengajuan_skripsi_id'),
      'nama_pengajuan_skripsi'=> $request->input('nama_pengajuan_skripsi'),
      'deskripsi_pengajuan_skripsi'=> $request->input('deskripsi_pengajuan_skripsi'),
    ];
    $data = $this->query->getSave($request);
    return $data;
  }

  public function getDelete($pengajuanSkripsiId){
    $data = [
      'pengajuan_skripsi_id'=>$pengajuanSkripsiId
    ];
    $data = $this->query->getDelete($data);
    return $data;
  }
}
