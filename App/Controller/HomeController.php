<?php

namespace App\Controller;
use App\Core\Controller;

class HomeController extends Controller{

  public function __construct(){
    parent::__construct();
  }

  public function index(){
      $this->Load("layout/home.php");
  }
}
?>
