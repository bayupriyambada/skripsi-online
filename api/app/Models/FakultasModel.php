<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FakultasModel extends Model {
  
  protected $table = 'fakultas';
  protected $primaryKey = 'fakultas_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->whereNull('dihapus_pada')
    ->selectRaw(
    '*, ROW_NUMBER() over(ORDER BY fakultas_id DESC) no_urut'
    );
  }
}
