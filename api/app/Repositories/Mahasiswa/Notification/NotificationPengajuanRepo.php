<?php

namespace App\Repositories\Mahasiswa\Notification;

use Carbon\Carbon;
use App\Helpers\ResponseHelpers;
use App\Helpers\ConstantaHelpers;
use App\Models\Notifications\NotificationPengajuanModel;

class NotificationPengajuanRepo
{

  public function getNotificationPengajuan(){
    try {
      $data = NotificationPengajuanModel::data()->where('mahasiswa_id', auth()->guard('api_mahasiswa')->user()->mahasiswa_id)->where('dikirim_pada' , '<=', Carbon::now()->addDays(7))->get();
      return ResponseHelpers::successJson(200, ConstantaHelpers::GET_DATA , $data);
    } catch (\Throwable $th) {
      return ResponseHelpers::errorCatch(400, $th->getMessage());
    }
  }
}
