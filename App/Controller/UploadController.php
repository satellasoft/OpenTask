<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\UploadModel;
use App\Entity\Upload;

use App\Core\uploadFile;

class UploadController extends Controller{
  private $uploadModel;

  public function __construct(){
    parent::__construct();

    $this->uploadModel = new UploadModel();
  }

  public function store(){
    $taskId = filter_input(INPUT_POST, "txtTaskId", FILTER_SANITIZE_NUMBER_INT);
    $type   = filter_input(INPUT_POST, "slType", FILTER_SANITIZE_STRING);
    $title  = filter_input(INPUT_POST, "txtUploadTitle", FILTER_SANITIZE_STRING);
    $file = $_FILES["flFile"];
    //-----------------------\\
    $uploadFile = new UploadFile();
    $result = $uploadFile->upload($file, $type);
    $message = "";//In case error
    //-1 = invalid mimetype, -10 = size is larges, -100 = error on upload
    if(strlen($result) > 5){

      $upload = new Upload();
      $upload->setTitle($title);
      $upload->setType($type);
      $upload->setFile($result);
      $upload->getTask()->setId($taskId);
      $upload->getUser()->setId($_SESSION['i']);

      if($this->uploadModel->store($upload) > 0){
        redirect(BASE . "task/show/{$taskId}#" . ($type == "f" ? "dvFiles" : "dvImages"));
      }else{
        $message = "Houve um erro inesperado ao tentar cadastrar, tente mais tarde";
        unlink(($type == "f" ? FILE_PATH : IMAGE_PATH) . "/" . $result);
      }
    }elseif($result == -1){
      $message = "Mimetype inválido " . $file["type"];
    }elseif($result == -10){
      $message = "O tamanho do arquivo é maior do que o suportado inválido [" . $file["size"] . " Bytes]";
    }elseif($result == -1){
      $message = "Houve um erro inesperado, tente mais tarde";
    }

    $this->Load("upload/result.php", [
      "message" => $message,
      "taskId" => $taskId
    ]);
  }

  function remove($uploadId = 0, $taskId = 0){
    $uploadId = filter_var($uploadId, FILTER_SANITIZE_NUMBER_INT);
    $taskId   = filter_var($taskId, FILTER_SANITIZE_NUMBER_INT);

    if($uploadId <= 0 || $taskId <= 0 || !isset($_SESSION["i"])){
      $this->Load("upload/result.php", [
        "message" => "Dados inválidos",
        "taskId" => $taskId
      ]);
      return;
    }

    $file = $this->uploadModel->getResumeFileById($uploadId);

    if($file->userId != $_SESSION["i"]){
      $this->Load("upload/result.php", [
        "message" => "Permissão negada",
        "taskId" => $taskId
      ]);
      return;
    }

    if($this->uploadModel->remove($uploadId, $_SESSION["i"])){
      unlink(($file->type == "f" ? FILE_PATH : IMAGE_PATH) . "/" . $file->file);
      redirect(BASE . "task/show/{$taskId}#" . ($file->type == "f" ? "dvFiles" : "dvImages"));
    }else{
      $this->Load("upload/result.php", [
        "message" => "Não foi possível remover",
        "taskId" => $taskId
      ]);
    }
  }

}
