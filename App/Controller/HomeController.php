<?php

namespace App\Controller;
use App\Core\Controller;

class HomeController extends Controller{

  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $listProject = (new \App\Model\UserProjectModel())->getMyProjects($_SESSION['i']);
    $this->Load("layout/home.php", ["listProject" => $listProject]);
  }

  public function Headerindex(){
    echo "<title>Home - Open Task</title>";
  }
}
?>
