<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\UserProject;

class UserProjectModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(UserProject $userProject){
    try{
      $sql = "INSERT INTO user_project (user_id, project_id, up_position)
      VALUES (:userid, :projectid, :position)";
      $params = array(
        ":userid" => $userProject->getUser()->getId(),
        ":projectid" => $userProject->getProject()->getId(),
        ":position" => $userProject->getPosition(),
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  //Get All user where not inserted in user_project
  public function getAll($projectId){
    try{
      $sql = "SELECT u.id, u.us_name, u.us_email, u.us_login, u.us_permission, up.up_position, up.up_status FROM user u INNER JOIN user_project up ON up.user_id = u.id AND up.project_id = :projectid ORDER BY u.us_name ASC";
      $param = array(
        ":projectid" => $projectId
      );
      $dt = $this->pdo->ExecuteQuery($sql, $param);
      $listUser = [];

      foreach($dt as $dr){
        $listUser[] = (object)[
          "id" => $dr['id'],
          "name" => $dr['us_name'],
          "email" => $dr['us_email'],
          "login" => $dr['us_login'],
          "permission" => $dr['us_permission'],
          "position" => $dr['up_position'],
          "status" => $dr['up_status']
        ];
      }

      return $listUser;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function changeStatus($userId, $projectId, $status){
    try{
      $sql = "UPDATE user_project SET up_status = :status WHERE user_id = :userid AND project_id = :projectid";
      $params = array(
        ":status" => $status,
        ":userid" => $userId,
        ":projectid" => $projectId
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getMyProjects($userId){
    try{
      $sql = "SELECT p.id, p.pr_title, p.pr_deadline, p.pr_created FROM project p INNER JOIN user_project up ON up.project_id = p.id AND up.user_id = :userid WHERE up.up_status = 1 AND p.pr_status = 1 ORDER BY p.pr_created ASC";
      $param = array(
        ":userid" => $userId
      );

      $dt = $this->pdo->ExecuteQuery($sql, $param);
      $listProject = [];

      foreach($dt as $dr){
        $listProject[] = (object)array(
          "id" => $dr["id"],
          "title" => $dr["pr_title"],
          "deadline" => $dr["pr_deadline"],
          "created" => $dr["pr_created"]
        );
      }

      return $listProject;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function checkPermission($projectId, $userId){
    try{
      $sql = "select up_status FROM user_project WHERE user_id = :userid AND project_id = :projectid AND up_status = :status";
      $params = [
        ":userid" => $userId,
        ":projectid" => $projectId,
        ":status" => 1//active
      ];

      return ($this->pdo->NumberRows($sql, $params) == 1);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getUserProjects($userId){
    try {
      $sql = "SELECT project_id as id FROM user_project WHERE user_id = :userid AND up_status = :status";
      $params = array(
        ":userid" => $userId,
        ":status" => 1//active
      );

      $dt = $this->pdo->ExecuteQuery($sql, $params);
      $list = [];
      foreach($dt as $dr){
        $list[] = $dr['id'];
      }
      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
