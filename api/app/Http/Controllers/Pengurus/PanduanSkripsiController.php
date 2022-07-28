<?php

namespace App\Http\Controllers\Pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Pengurus\PanduanSkripsiRepo;

class PanduanSkripsiController extends Controller{
  public PanduanSkripsiRepo $query;
  public function __construct()
  {
    $this->query = new PanduanSkripsiRepo();
  }

  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
  public function getSave(Request $request){
    $data = [
      'panduan_skripsi_id'=> $request->input('panduan_skripsi_id'),
      'keterangan'=> $request->input('keterangan'),
    ];
    $data = $this->query->getSave($request);
    return $data;
  }
  
  public function getDelete($panduanSkripsiId){
    $data = [
      'panduan_skripsi_id'=>$panduanSkripsiId
    ];
    $data = $this->query->getDelete($data);
    return $data;
  }
}
