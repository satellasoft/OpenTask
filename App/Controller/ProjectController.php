<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\ProjectModel;
use App\Entity\Project;

class ProjectController extends Controller{

  private $projectModel;

  public function __construct(){
    parent::__construct();
    $this->projectModel= new ProjectModel();
  }

  private function protectMethod(){
    if($_SESSION["p"] != 1)
      {
        echo "Você não possui permissão para acessar esse módulo.";
        die();
      }
  }

  /*SHOW PROJECT*/
  public function index(){
    $this->Load("project/list.php", ["listProject" => $this->projectModel->getAll()]);
  }

  public function Headerindex(){
    echo "<title>Project - Open Task</title>";
  }

  /*CREATE PROJECT*/
  public function create(){
    $this->Load("project/create.php");
  }

  public function Headercreate(){
    echo "<title>Project Create - Open Task</title>";
  }

  public function store(){
    $project = new Project();

    //VALIDATE html field
    $deadline = filter_input(INPUT_POST, "txtDeadline", FILTER_SANITIZE_STRING);

    $project->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $project->setDescription(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $project->setDeadline($deadline);
    $project->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $project->setCreated(getCurrentDate());
    $project->setUserID($_SESSION['i']);

    $msg = "";
    if($this->projectModel->store($project))
      $msg = "<span class='text-success'>Projeto criado</span>";
    else
      $msg = "<span class='text-danger'>Houve um erro ao tentar criar o projeto</span>";

    $this->Load("project/result.php", ["message" => $msg]);
  }
}
