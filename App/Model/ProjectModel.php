<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Project;

class ProjectModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Project $project){
    try{
      $sql = "INSERT INTO project (pr_title, pr_description, pr_deadline, pr_created, pr_status, user_id) VALUES (:title, :description, :deadline,:created, :status, :userid)";
      $params = array(
        ":title" => $project->getTitle(),
        ":description" => $project->getDescription(),
        ":deadline" => $project->getDeadline(),
        ":created" => $project->getCreated(),
        ":status" => $project->getStatus(),
        ":userid" => $project->getUserID()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function update(Project $project){
    try{
      $sql = "UPDATE project SET pr_title = :title, pr_description = :description, pr_deadline = :deadline, pr_status = :status WHERE id = :id";
      $params = array(
        ":title" => $project->getTitle(),
        ":description" => $project->getDescription(),
        ":deadline" => $project->getDeadline(),
        ":status" => $project->getStatus(),
        ":id" => $project->getId());

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getAll(){
    try{
      $sql = "SELECT id, pr_title, pr_deadline, pr_created, pr_status FROM project ORDER BY pr_created DESC";

      $dt = $this->pdo->ExecuteQuery($sql);
      $list = [];

      foreach($dt as $dr){
        $list[] = (object)array(
          "id"    => $dr["id"],
          "title"    => $dr["pr_title"],
          "deadline" => $dr["pr_deadline"],
          "created"  => $dr["pr_created"],
          "status"  => $dr["pr_status"]
        );
      }

      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }


  public function getById($id){
    try{
      $sql = "SELECT p.pr_title, p.pr_description, p.pr_deadline, p.pr_created, p.pr_status, u.us_name, u.us_permission FROM project p INNER JOIN user u ON u.id = p.user_id WHERE p.id = :id";
      $param = array(
        ":id" => $id
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)array(
        "title"     => $dr["pr_title"],
        "description"  => $dr["pr_description"],
        "deadline"  => $dr["pr_deadline"],
        "created"   => $dr["pr_created"],
        "status"    => $dr["pr_status"],
        "userName"  => $dr["us_name"],
        "userPermission"  => $dr["us_permission"]
      );

    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getResumeById($id){
    try{
      $sql = "SELECT pr_title, pr_description, pr_deadline, pr_status FROM project WHERE id = :id AND pr_status = :status";
      $param = array(
        ":id" => $id,
        ":status" => 1//Active, nor cancel and finished
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)array(
        "title"     => $dr["pr_title"],
        "description"  => $dr["pr_description"],
        "deadline"  => $dr["pr_deadline"],
        "status"    => $dr["pr_status"]
      );

    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }
}
