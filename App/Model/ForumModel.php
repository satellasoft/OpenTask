<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Forum;

class ForumModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Forum $forum){
    try{
      $sql = "INSERT INTO forum (fr_title, fr_content, fr_created, task_id, user_id) VALUES (:title, :content, :created, :taskid, :userid)";

      $params = array(
        ":title" => $forum->getTitle(),
        ":content" => $forum->getContent(),
        ":created" => $forum->getCreated(),
        ":taskid" => $forum->getTask()->getId(),
        ":userid" => $forum->getUser()->getId()
      );

      $result = $this->pdo->ExecuteNonQuery($sql, $params);

      if($result)
      return $this->pdo->GetLastID();
      else
      return -1;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getByTaskId($taskId){
    try{
      $sql = "SELECT f.id, f.fr_title, f.fr_content, f.fr_created, t.id as taskid, t.tk_title as taskname, u.us_name FROM forum f INNER JOIN task t ON t.id = f.task_id INNER JOIN user u ON u.id = f.user_id WHERE f.id = :taskid";
      $param = array(
        ":taskid" => $taskId
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      $forum = new Forum();
      $forum->setId($dr["id"]);
      $forum->setTitle($dr["fr_title"]);
      $forum->setContent($dr["fr_content"]);
      $forum->setCreated($dr["fr_created"]);
      $forum->getTask()->setId($dr["taskid"]);
      $forum->getTask()->setTitle($dr["taskname"]);
      $forum->getUser()->setName($dr["us_name"]);

      return $forum;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getAll($taskId){
    try{
      $sql  = "SELECT f.id, f.fr_title, f.fr_content, f.fr_created, u.us_name FROM forum f INNER JOIN user u ON u.id = f.user_id WHERE f.task_id = :taskid ORDER BY f.fr_created DESC";
      $param = array(
        ":taskid" => $taskId
      );

      $dt = $this->pdo->ExecuteQuery($sql, $param);
      $listForum = [];

      foreach($dt as $dr){
        $listForum[] = (object)[
          "id" => $dr["id"],
          "title" => $dr["fr_title"],
          "content" => $dr["fr_content"],
          "created" => $dr["fr_created"],
          "userName" => $dr["us_name"]
        ];
      }

      return $listForum;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
