<?php

namespace App\Http\Controllers\Publik;

use App\Http\Controllers\Controller;
use App\Repositories\Publik\DataPublikRepo;

class DataPublikController extends Controller{

  public function getFakultas(){
   $data = (new DataPublikRepo())->getFakultas();
   return $data;
  }
  public function getGelombang(){
   $data = (new DataPublikRepo())->getGelombang();
   return $data;
  }
  public function getPanduan(){
   $data = (new DataPublikRepo())->getPanduan();
   return $data;
  }
}
