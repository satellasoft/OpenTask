<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\TaskModel;
use App\Model\ForumModel;
use App\Model\UploadModel;
use App\Entity\Task;

class TaskController extends Controller{

  private $taskModel;

  public function __construct(){
    parent::__construct();

    $this->taskModel = new TaskModel();
  }

  public function index(){
    $this->Load("layout/404.php");
  }

  public function create(){
    $this->Load("task/create.php");
  }

  public function Headercreate(){
    echo "<title>Task - Open Task</title>";
  }

  public function store(){
    $task = new Task();

    $task->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $task->setDescription(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $task->setDeadline(filter_input(INPUT_POST, "txtDeadline", FILTER_SANITIZE_STRING));
    $task->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $task->setCreated(getCurrentDate());
    $task->getUser()->setId($_SESSION["i"]);
    $task->getProject()->setId($_COOKIE['pi']);

    $id = $this->taskModel->store($task);

    if($id > 0)
    redirect(BASE . "task/show/{$id}");
    else
    $this->Load("task/result.php", ["message" => "Houve um erro ao tentar cadastrar"]);
  }

  //UPDATE
  public function edit($id = 0){
    if($id < 0 || !isset($_COOKIE['pi'])){
      $this->notFound();
      return;
    }

    $task = $this->taskModel->getById($id, $_COOKIE['pi']);

    if($task->title == null || $task->userid != $_SESSION['i']){
      $this->notFound();
      return;
    }

    $editable = $task->completed == null;

    $this->Load("task/edit.php", [
      "task" => $task,
      "editable" => $editable
    ]);
  }

  public function Headeredit(){
    echo "<title>Edit - Open Task</title>";
  }

  public function update(){
    $task = new Task();

    $task->setId(filter_input(INPUT_POST, "txtId", FILTER_SANITIZE_NUMBER_INT));
    $task->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $task->setDescription(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $task->setDeadline(filter_input(INPUT_POST, "txtDeadline", FILTER_SANITIZE_STRING));
    $task->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));

    if($task->getStatus() == 3){
      $task->setCompleted(getCurrentDate());
    }

    $task->getUser()->setId($_SESSION["i"]);
    $task->getProject()->setId($_COOKIE['pi']);

    $id = $this->taskModel->update($task);

    if($id > 0)
    redirect(BASE . "task/edit/{$id}");
    else
    $this->Load("task/result.php", ["message" => "Houve um erro ao tentar cadastrar"]);
  }

  public function show($id = 0){
    if($id <= 0 || !isset($_SESSION["i"]) || !isset($_COOKIE['pi'])){
      $this->Load("layout/404.php");
      return;
    }

    $task = $this->taskModel->getById($id, $_COOKIE['pi']);

    if($task->title == null){
      $this->Load("task/result.php", ["message" => "Tarefa não encontrada"]);
      return;
    }else{
      $this->Load("task/show.php",
      [
        "task"    => $task,
        "forum"   => (new ForumModel())->getAll($id),
        "uploads" => (new UploadModel())->getAllByTaskId($id),
        "userId"  => $_SESSION["i"]
      ]);
    }
  }

  public function Headershow(){
    echo "<title>Task - Open Task</title>";
    echo "<link rel='stylesheet' href='".BASE."vendor/highlight/styles/atom-one-dark.css'>";
  }
}
?>
