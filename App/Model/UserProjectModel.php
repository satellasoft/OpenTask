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
}
