<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Category;

class CategoryModel{

  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Category $category){
    try{
      $sql = "INSERT INTO task_category (tc_name, tc_register, project_id) VALUES (:name, :register, :projectid)";
      $params = array(
        ":name"      => $category->getName(),
        ":register"  => $category->getRegister(),
        ":projectid" => $category->getProject()->getId()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function update(Category $category){
    try{
      $sql = "UPDATE task_category SET tc_name = :name WHERE id = :id";
      $params = array(
        ":id"   => $category->getId(),
        ":name" => $category->getName()
      );

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getAllByProjectId(int $projectId){
    try{
      $sql = "SELECT id, tc_name, tc_register, project_id FROM task_category WHERE project_id = :projectid ORDER BY tc_name DESC";

      $dt = $this->pdo->ExecuteQuery($sql, [
        ":projectid" =>$projectId
      ]);

      $list = [];

      foreach($dt as $dr){
        $list[] = (object)array(
          "id"    => $dr["id"],
          "name"    => $dr["tc_name"],
          "register" => $dr["tc_register"],
          "projectId" => $dr["project_id"]
        );
      }

      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getById(int $id){
    try{
      $sql = "SELECT id, tc_name, tc_register, project_id FROM task_category WHERE id = :id";
      $param = array(
        ":id" => $id
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);

      return (object)array(
        "id"     => $dr["id"],
        "name"   => $dr["tc_name"],
        "register"    => $dr["tc_register"],
        "projectId"   => $dr["project_id"]
      );

    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }
}
