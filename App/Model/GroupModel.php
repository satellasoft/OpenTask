<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Group;

class GroupModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Group $group){
    try{
      $sql = "INSERT INTO group (user_id, project_id)
      VALUES (:userid, :projectid)";
      $params = array(
        ":name" => $user->getName(),
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function update(Group $group){
    try{
      $sql = "UPDATE user SET us_name = :name, us_email = :email, us_login = :login, us_permission = :permission, us_status = :status WHERE id = :id";
      $params = array(
        "id" => $user->getId()
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
      $sql = "SELECT u.id, u.us_name, u.us_email, u.us_login, u.us_permission FROM user u INNER JOIN user_project up ON up.user_id = u.id AND up.project_id = :projectid ORDER BY u.us_name ASC";
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
          "permission" => $dr['us_permission']
        ];
      }

      return $listUser;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
