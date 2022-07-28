<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenMahasiswaModel extends Model {
  
  protected $table = 'dosen_mahasiwa';
  protected $primaryKey = 'dosen_mahasiwa_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->whereNull('dihapus_pada')
    ->selectRaw(
    '*, ROW_NUMBER() over(ORDER BY dosen_mahasiwa_id DESC) no_urut'
    );
  }

  public function getMahasiswa()
  {
  return $this->belongsTo('App\Models\Mahasiswa' , 'mahasiswa_id' ,
  'mahasiswa_id')->select('mahasiswa_id','nimn','username','email','fakultas_id');
  }

  public function getDospem()
  {
  return $this->belongsTo('App\Models\Dospem' , 'dospem_id' ,
  'dospem_id')->select('dospem_id','nidn','username','email','fakultas_id');
  }
}
