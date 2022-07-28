<?php

namespace App\Http\Controllers\Kaprodi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Kaprodi\GelombangRepo;

class GelombangController extends Controller{
  public GelombangRepo $query;
  public function __construct()
  {
    $this->query = new GelombangRepo();
  }

  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
  public function getSave(Request $request){
    $data = [
      'gelombang_skripsi_id'=> $request->input('gelombang_skripsi_id'),
      'gelombang'=> $request->input('gelombang'),
      'date_mulai'=> $request->input('date_mulai'),
      'date_selesai'=> $request->input('date_selesai'),
      'gelombang_status'=> $request->input('gelombang_status'),
    ];
    $data = $this->query->getSave($request);
    return $data;
  }
  
  public function getDelete($gelombangId){
    $data = [
      'gelombang_id'=>$gelombangId
    ];
    $data = $this->query->getDelete($data);
    return $data;
  }
}
