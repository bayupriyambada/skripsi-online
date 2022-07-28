<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class NotificationPengajuanModel extends Model {
  
  protected $table = 'notification_pengajuan';
  public $incrementing = false;
  // protected $primaryKey = 'notification_pengajuan_id';
  public $timestamps = false;

  public function scopeData($query){
    return $query->orderBy('dikirim_pada' , 'Desc');
  }

  protected function getStatusDataPengajuanAttribute()
  {
  if ($this->attributes['status_data_pengajuan'] == 1) {
    return 'Tolak';
    } elseif ($this->attributes['status_data_pengajuan'] == 2) {
    return 'Revisi';
    } elseif ($this->attributes['status_data_pengajuan'] == 3) {
    return 'Acc';
    } else {
    return 'Belum dibaca';
  }
  return $this->status_data_pengajuan;
  }
}
