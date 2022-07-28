<?php

namespace App\Http\Controllers\Pengurus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Pengurus\DospemMahasiswaRepo;

class DospemMahasiswaController extends Controller{
  public DospemMahasiswaRepo $query;
  public function __construct()
  {
    $this->query = new DospemMahasiswaRepo();
  }

  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
  public function getSave(Request $request){
    $data = [
      'dosen_mahasiswa_id'=> $request->input('dosen_mahasiswa_id'),
      'mahasiswa_id'=> $request->input('mahasiswa_id'),
      'dospem_id'=> $request->input('dospem_id'),
    ];
    $data = $this->query->getSave($request);
    return $data;
  }
  
  public function getDelete($dospemMahasiswaId){
    $data = [
      'dosen_mahasiswa_id'=>$dospemMahasiswaId
    ];
    $data = $this->query->getDelete($data);
    return $data;
  }
}
