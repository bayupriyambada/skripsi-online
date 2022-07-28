<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSkripsiModel extends Model {
  
  protected $table = 'pengajuan_skripsi';
  protected $primaryKey = 'pengajuan_skripsi_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->whereNull('dihapus_pada')
     ->selectRaw(
     '*, ROW_NUMBER() over(ORDER BY pengajuan_skripsi_id DESC) no_urut'
     )->with(['getMahasiswa']);

  }

  public function getMahasiswa()
  {
    return $this->belongsTo('App\Models\Mahasiswa' , 'mahasiswa_id' , 'mahasiswa_id')->select('mahasiswa_id','nimn','username','email','fakultas_id');
  }
  // protected function getTelahDisetujuiKaprodiAttribute()
  // {
  // if ($this->attributes['telah_disetujui_kaprodi'] == 1) {
  //   return 'Tolak';
  //   } elseif ($this->attributes['telah_disetujui_kaprodi'] == 2) {
  //   return 'Revisi';
  //   } elseif ($this->attributes['telah_disetujui_kaprodi'] == 3) {
  //   return 'Acc';
  //   } else {
  //   return 'Belum dibaca';
  // }

  // // return $this->telah_disetujui_kaprodi;
  // }
}
