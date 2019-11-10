<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\UserProjectModel;
use App\Model\TaskModel;

class CalendarController extends Controller{

  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $strIds = "";

    $userProject = new UserProjectModel();
    $userProjects = ($userProject->getUserProjects($_SESSION['i']));

    if(count($userProjects) > 0){
      $strIds = implode(",", $userProjects);//Convert array to string: 1,2,5,90,111
    }

    $this->Load("calendar/show.php",
    ["strIds" => $strIds]);
  }

  public function headerIndex(){
    echo "<title>Calendário - Open Task</title>";
  }
}
