<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Entity\Project;

class GroupController extends Controller{

  private $groupModel;

  public function __construct(){
    parent::__construct();
    $this->groupModel= new GroupModel();
  }

  public function index(){
      $this->Load("layout/404.php");
  }

  /*SHOW Group*/
  public function show($projectId){
    $this->protectMethod();

    $this->Load("group/show.php", ["listUser" => $this->groupModel->getAll($projectId)]);
  }

}
