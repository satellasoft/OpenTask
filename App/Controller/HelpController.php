<?php

namespace App\Controller;
use App\Core\Controller;

class HelpController extends Controller{

  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $this->Load("help/main.php");
  }

  public function Headerindex(){
    echo "<title>Help - Open Task</title>";
  }
}
?>
