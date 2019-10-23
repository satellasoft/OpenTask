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

  public function getAll(){
    try{
      $sql = "SELECT pr_title, pr_deadline, pr_created, pr_status FROM project ORDER BY pr_created DESC";

      $dt = $this->pdo->ExecuteQuery($sql);
      $list = [];

      foreach($dt as $dr){
        $list[] = (object)array(
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
}
