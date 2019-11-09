<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\UserProjectModel;
use App\Model\UserModel;
use App\Entity\UserProject;

class UserProjectController extends Controller{

  private $userProjectModel;

  public function __construct(){
    parent::__construct();
    $this->userProjectModel = new UserProjectModel();
  }

  public function index(){
    $this->Load("layout/404.php");
  }

  /*SHOW Group*/
  public function show($projectId){
    $this->protectMethod();

    $this->Load("userproject/show.php", [
      "listUserProject" => $this->userProjectModel->getAll($projectId),
      "listUserNotProject" => (new UserModel())->getAllNotProject($projectId),
      "projectId" => $projectId
    ]);
  }

  public function Headershow(){
    echo "<title>User Project - Open Task</title>";
  }

  public function store(){
    $this->protectMethod();

    $userProject = new UserProject();
    $userProject->getProject()->setId(filter_input(INPUT_POST, "txtProjectId", FILTER_SANITIZE_NUMBER_INT));
    $userProject->getUser()->setId(filter_input(INPUT_POST, "slUserId", FILTER_SANITIZE_NUMBER_INT));
    $userProject->setPosition(filter_input(INPUT_POST, "txtPosition", FILTER_SANITIZE_STRING));

    $message = "";
    $projectId = $userProject->getProject()->getId();

    if($this->userProjectModel->store($userProject)){
      redirect(BASE . "userProject/show/". $projectId);
    }else{
      $message = "<span class='text-success'>Houve um erro ao tentar inserir</span>";
    }

    $this->Load("userproject/result.php", [
      "message" => $message,
      "id" => $projectId
    ]);
  }

  public function changeStatus($userId, $projectId, $status){
    $this->protectMethod();

    $status = ($status == 1 ? 2 : 1);

    if($this->userProjectModel->changeStatus($userId, $projectId, $status)){
      redirect(BASE . "userProject/show/". $projectId);
    }

    $this->Load("userproject/result.php", [
      "message" => "<span class='text-success'>Houve um erro ao tentar alterar o status</span>",
      "id" => $projectId
    ]);
  }

  public function Httpcheck($projectId = 0){
    if($projectId <= 0 ){
      echo "Invalid ID";
      return;
    }

    if($this->userProjectModel->checkPermission($projectId, $_SESSION['i'])){
      setcookie("pi", $projectId, (time()+86400), BASE);
      redirect(BASE."project/myproject/");
    }else{
      $this->Load("layout/denied.php");
    }
  }
}
