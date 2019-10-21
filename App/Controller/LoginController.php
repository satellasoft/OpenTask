<?php

namespace App\Controller;
use App\Core\Controller;

class LoginController extends Controller{

  public function index(){
    $this->Load("layout/login.php");
  }

  public function indexHeader(){
    echo "<title>Login - Open Task</title>";
  }
}
?>
