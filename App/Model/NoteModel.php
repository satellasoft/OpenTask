<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Note;

class NoteModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Note $note){
    try{
      $sql = "INSERT INTO note (nt_title, nt_created, nt_content, nt_color, nt_status, project_id, user_id) VALUES (:title, :created, :content, :color, :status, :projectid, :userid)";
      $params = array(
        ":title" => $note->getTitle(),
        ":created" => $note->getCreated(),
        ":content" => $note->getContent(),
        ":color" => $note->getColor(),
        ":status" => $note->getStatus(),
        ":projectid" => $note->getProject()->getId(),
        ":userid" => $note->getUser()->getId()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function update(Note $note){
    try{
      $sql = "UPDATE note SET nt_title = :title, nt_content = :content, nt_color = :color, nt_status = :status WHERE id = :id AND nt_status = 1 AND user_id = :userid";
      $params = array(
        ":title" => $note->getTitle(),
        ":content" => $note->getContent(),
        ":color" => $note->getColor(),
        ":status" => $note->getStatus(),
        ":id" => $note->getId(),
        ":userid" => $note->getUser()->getId()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getAllResumed($projectId, $limit = 4){
    try{
      $sql = "SELECT id, nt_title, nt_color, user_id FROM note WHERE nt_status = 1 AND project_id = :projectid ORDER BY nt_created DESC LIMIT :limit";
      $params = array(
        ":projectid" => $projectId,
        ":limit" => $limit
      );

      $dt = $this->pdo->ExecuteQuery($sql, $params);
      $listNote =[];

      foreach ($dt as $dr) {
        $listNote[] = (object)[
          "id" => $dr["id"],
          "title" => $dr["nt_title"],
          "color" => $dr["nt_color"],
          "userid" => $dr["user_id"]
        ];
      }

      return $listNote;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getById($projectId, $noteId){
    try {
      $sql = "SELECT n.nt_title, n.nt_created, n.nt_content, n.nt_color, u.us_name, u.id as userid FROM note n INNER JOIN user u ON u.id = n.user_id WHERE n.nt_status = 1 AND n.project_id = :projectid AND n.id = :noteid";
      $params = array(
        ":projectid" => $projectId,
        ":noteid" => $noteId,
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $params);

      return (object)[
        "id" => $noteId,
        "title" => $dr["nt_title"],
        "created" => $dr["nt_created"],
        "content" => $dr["nt_content"],
        "color" => $dr["nt_color"],
        "username" => $dr["us_name"],
        "userid" => $dr["userid"]
      ];
    } catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }


  public function getEditById($noteId, $userId){
    try{
      $sql = "SELECT nt_title, nt_content, nt_color, nt_status FROM note WHERE id = :noteid AND user_id = :userid AND nt_status = 1";
      $param = array(
        ":noteid" => $noteId,
        ":userid" => $userId
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)[
        "title" => $dr["nt_title"],
        "content" => $dr["nt_content"],
        "color" => $dr["nt_color"],
        "status" => $dr["nt_status"]
      ];
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }
}
