<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\NoteModel;
use App\Entity\Note;
use App\Controller\UserProjectController;

class NoteController extends Controller{

  private $noteModel;

  public function __construct(){
    parent::__construct();
    $this->noteModel= new NoteModel();
  }

  /*SHOW PROJECT*/
  public function index(){
    $this->Load("note/list.php", [
      "listNote" => $this->noteModel->getAllResumed($_COOKIE['pi'], 999)
    ]);
  }

  public function Headerindex(){
    echo "<title>Note - Open Task</title>";
  }

  public function show($noteId){
    $this->Load("note/show.php", [
      "note" => $this->noteModel->getById($_COOKIE['pi'], $noteId)
    ]);
  }

  public function Headershow(){
    echo "<title>Read Note - Open Task</title>";
  }

  public function create(){
    $this->Load("note/create.php");
  }

  public function Headercreate(){
    echo "<title>New Note - Open Task</title>";
  }

  //--------------------------------------------
  public function edit($noteId = 0){
    if($noteId <= 0){
      $this->Load("layout/404.php");
      return;
    }

    $note =  $this->noteModel->getEditById($noteId, $_SESSION['i']);

    if($note->title == null){
      $this->Load("layout/denied.php");
      return;
    }

    $this->Load("note/edit.php", [
      "id" => $noteId,
      "note" => $note
    ]);
  }

  public function Headeredit(){
    echo "<title>Edit Note - Open Task</title>";
  }

  public function store(){

    $note = new Note();

    $note->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $note->setColor(filter_input(INPUT_POST, "slColor", FILTER_SANITIZE_STRING));
    $note->setContent(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $note->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $note->setCreated(getCurrentDate());
    $note->getUser()->setId($_SESSION['i']);
    $note->getProject()->setId($_COOKIE['pi']);

    $msg = "";
    if($this->noteModel->store($note))
    $msg = "<span class='text-success'>Nota criada</span>";
    else
    $msg = "<span class='text-danger'>Houve um erro ao tentar criar a nota</span>";

    $this->Load("note/result.php", ["message" => $msg]);
  }

  public function update(){

    $note = new Note();

    $note->setId(filter_input(INPUT_POST, "txtId", FILTER_SANITIZE_NUMBER_INT));
    $note->setTitle(filter_input(INPUT_POST, "txtTitle", FILTER_SANITIZE_STRING));
    $note->setColor(filter_input(INPUT_POST, "slColor", FILTER_SANITIZE_STRING));
    $note->setContent(filter_input(INPUT_POST, "txtDescription", FILTER_SANITIZE_SPECIAL_CHARS));
    $note->setStatus(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $note->getUser()->setId($_SESSION['i']);

    $msg = "";
    if($this->noteModel->update($note))
      redirect(BASE. "note/show/".$note->getId());
    else
    $msg = "<span class='text-danger'>Houve um erro ao tentar editar a nota</span>";

    $this->Load("note/result.php", ["message" => $msg]);
  }

}
