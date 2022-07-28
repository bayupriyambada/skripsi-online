<?php

namespace App\Http\Controllers\Kaprodi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Kaprodi\FakultasRepo;

class FakultasController extends Controller{
  public FakultasRepo $query;
  public function __construct()
  {
    $this->query = new FakultasRepo();
  }
  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
  public function getSave(Request $request){
    $data = [
      'fakultas_id'=> $request->input('fakultas_id'),
      'singkat'=> $request->input('singkat'),
      'nama_fakultas'=> $request->input('nama_fakultas'),
    ];
    $data = $this->query->getSave($request);
    return $data;
  }

  public function getDelete($fakultasId){
    $data = [
      'fakultas_id'=>$fakultasId
    ];
    $data = $this->query->getDelete($data);
    return $data;
  }
}
