<?php

namespace App\Http\Controllers\Mahasiswa\Notification;

use App\Http\Controllers\Controller;
use App\Repositories\Mahasiswa\Notification\NotificationPengajuanRepo;

class GetNotificationController extends Controller{
  
  public function getNotificationPengajuan(){
    $data = (new NotificationPengajuanRepo)->getNotificationPengajuan();
    return $data;
  }
}
