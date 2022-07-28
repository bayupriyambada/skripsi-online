<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GelombangModel extends Model {
  
  protected $table = 'gelombang_skripsi';
  protected $primaryKey = 'gelombang_skripsi_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->whereNull('dihapus_pada')
     ->selectRaw(
     '*, ROW_NUMBER() over(ORDER BY gelombang_skripsi_id DESC) no_urut'
     );
  }
}
