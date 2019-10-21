<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\User;

class UserModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(User $user){
    try{
      $sql = "INSERT INTO user (us_name, us_email, us_login, us_password, us_permission, us_status, us_register)
      VALUES (:name, :email, :login, :password, :permission, :status, :register)";
      $params = array(
        ":name" => $user->getName(),
        ":email" => $user->getEmail(),
        ":login" => $user->getLogin(),
        ":password" => $user->getPassword(),
        ":permission" => $user->getPermission(),
        ":status" => $user->getStatus(),
        ":register" => $user->getRegister()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function update(User $user){
    try{
      $sql = "UPDATE user SET us_name = :name, us_email = :email, us_login = :login, us_permission = :permission, us_status = :status WHERE id = :id";
      $params = array(
        "id" => $user->getId(),
        ":name" => $user->getName(),
        ":email" => $user->getEmail(),
        ":login" => $user->getLogin(),
        ":permission" => $user->getPermission(),
        ":status" => $user->getStatus()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getAll(){
    try{
      $sql = "SELECT * FROM user ORDER BY us_status ASC";

      $dt = $this->pdo->ExecuteQuery($sql);
      $listUser = [];

      foreach($dt as $dr){
        $listUser[] = new User(
          $dr['id'],
          $dr['us_name'],
          $dr['us_email'],
          $dr['us_login'],
          null, //password
          $dr['us_permission'],
          $dr['us_status'],
          $dr['us_register']
        );
      }

      return $listUser;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getById($id){
    try{
      $sql = "SELECT us_name, us_email, us_login, us_permission, us_status FROM user WHERE id = :id";
      $param = array(
        ":id" => $id
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)array(
        "id" => $id,
        "name" => $dr['us_name'],
        "email" => $dr['us_email'],
        "login" => $dr['us_login'],
        "permission" => $dr['us_permission'],
        "status" => $dr['us_status']
      );
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function passwordReset($userId, $userPassword){
    try{
      $sql = "UPDATE user SET us_password = :password WHERE id = :id";
      $params = array(
        ":id" => $userId,
        ":password" => $userPassword
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getPasswaordHash($login){
    try{
      $sql = "SELECT us_password FROM user WHERE us_login = :login AND us_status = 1";
      $param = array(
        ":login" => $login
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
      return $dr["us_password"];
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getResumeLogin($login){
    try{
      $sql = "SELECT id, us_name, us_permission FROM user WHERE us_login = :login";
      $param = array(
        ":login" => $login
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)array(
        "id" => $dr["id"],
        "name" => $dr["us_name"],
        "permission" => $dr["us_permission"]
      );
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
