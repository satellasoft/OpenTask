<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\ForumModel;
use App\Entity\Forum;

class ForumController extends Controller{

  private $forumModel;

  public function __construct(){
    parent::__construct();

    $this->forumModel = new ForumModel();
  }

  public function index(){
    $this->Load("layout/404.php");
  }

  public function create($taskId = 0){
    $taskId =  filter_var($taskId, FILTER_SANITIZE_NUMBER_INT);
    if($taskId <= 0) {
      $this->notFound();
      return;
    }

    $this->Load("forum/create.php",
    [
      "taskId" => $taskId
    ]);
  }

  public function Headercreate(){
    echo "<title>Forum - Open Task</title>";
  }

  public function store(){
    $forum = new Forum();
    $forum->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $forum->setContent(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $forum->setCreated(getCurrentDate());
    $forum->getTask()->setId(filter_input(INPUT_POST, "txtTaskId", FILTER_SANITIZE_NUMBER_INT));
    $forum->getUser()->setId($_SESSION['i']);

    $result = $this->forumModel->store($forum);

    if($result > 0){
      redirect(BASE . "forum/show/" . $result);
    }else{
      $this->Load("forum/result.php",
      [
        "message" => "Não foi possível criar um novo fórum. Tente mais tarde..."
      ]);
    }
  }

  ///SHOW
  public function show($taskId = 0){
    $taskId =  filter_var($taskId, FILTER_SANITIZE_NUMBER_INT);
    if($taskId <= 0) {
      $this->notFound();
      return;
    }

    $this->Load("forum/show.php",
    ["forum" => $this->forumModel->getById($taskId)]);
  }

  public function Headershow(){
    echo "<title>Topic Forum - Open Task</title>";
    echo "<link rel='stylesheet' href='".BASE."highlight/styles/atom-one-dark.css'>";
  }
}
