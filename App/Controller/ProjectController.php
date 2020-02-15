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

  /*SHOW PROJECT*/
  public function index(){
    $this->protectMethod();
    $this->Load("project/list.php", ["listProject" => $this->projectModel->getAll()]);
  }

  public function Headerindex(){
    echo "<title>Project - Open Task</title>";
  }

  /*CREATE PROJECT*/
  public function create(){
    $this->protectMethod();
    $this->Load("project/create.php");
  }

  public function Headercreate(){
    echo "<title>Project Create - Open Task</title>";
  }

  public function store(){
    $this->protectMethod();
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

  /*EDIT PROJECT*/
  public function edit($id = 0){
    $this->protectMethod();
    if($id > 0){
      $project = $this->projectModel->getResumeById($id);
      if($project->title != null){
        $this->Load("project/edit.php", [
          "project" => $project,
          "id" => $id
        ]);
      }else{
        $this->Load("project/result.php", ["message" => "<span class='text-warning'>Projeto não encontrado</span>"]);
      }
    }else{
      $this->Load("project/result.php", ["message" => "<span class='text-danger'>ID inválido</span>"]);
    }
  }

  public function Headeredit(){
    echo "<title>Project Edit - Open Task</title>";
  }

  public function update(){
    $this->protectMethod();
    $project = new Project();

    //VALIDATE html field
    $deadline = filter_input(INPUT_POST, "txtDeadline", FILTER_SANITIZE_STRING);

    $project->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $project->setDescription(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $project->setDeadline($deadline);
    $project->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $project->setId(filter_input(INPUT_POST, "txtId", FILTER_SANITIZE_NUMBER_INT));

    $msg = "";
    if($this->projectModel->update($project))
    $msg = "<span class='text-success'>Projeto editado</span>";
    else
    $msg = "<span class='text-danger'>Houve um erro ao tentar editar o projeto</span>";

    $this->Load("project/result.php", ["message" => $msg]);
  }

  /*SHOW*/
  public function show($id = 0){
    $this->protectMethod();
    if($id > 0){
      $project = $this->projectModel->getById($id);

      if($project->title != null){
        $this->Load("project/show.php", [
          "project" => $project,
          "id" => $id]);
        }else{
          $this->Load("project/result.php", ["message" => "<span class='text-warning'>Projeto não encontrado</span>"]);
        }
      }else{
        $this->Load("project/result.php", ["message" => "<span class='text-danger'>ID inválido</span>"]);
      }
    }

    public function Headershow(){
      echo "<title>Project show - Open Task</title>";
    }

    public function myProject(){
      $project = $this->projectModel->getById($_COOKIE['pi']);
      $notes = (new \App\Model\NoteModel())->getAllResumed($_COOKIE['pi'], 6);
      $task = (new \App\Model\TaskModel())->getAllResumed($_COOKIE['pi']);
      $this->Load("project/myproject.php",
      [
        "project"  => $project,
        "listNote" => $notes,
        "listTask" => $task,
        "members" => (new \App\Model\UserProjectModel())->getAllByProject($_COOKIE['pi'])
      ]);
    }

    public function Headermyproject(){
      echo "<title>My Project - Open Task</title>";
    }
  }
