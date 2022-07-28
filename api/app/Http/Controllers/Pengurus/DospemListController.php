<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Repositories\Pengurus\DospemRepo;

class DospemListController extends Controller{
  public DospemRepo $query;
  public function __construct()
  {
    $this->query = new DospemRepo();
  }

  public function getList(){
    $data = $this->query->getList();
    return $data;
  }
}
