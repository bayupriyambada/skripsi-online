<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanSkripsiModel extends Model {
  
  protected $table = 'panduan_skripsi';
  protected $primaryKey = 'panduan_skripsi_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->whereNull('dihapus_pada')
     ->selectRaw(
     '*, ROW_NUMBER() over(ORDER BY panduan_skripsi_id ASC) no_urut'
     );
  }
}
