<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Task;

class TaskModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Task $task){
    try{
      $sql = "INSERT INTO task (tk_title, tk_description, tk_deadline, tk_created, tk_status, user_id, task_category_id, project_id) VALUES (:title, :description, :deadline, :created, :status, :userid, :taskcategoryid, :projectid)";

      $params = array(
        ":title"       => $task->getTitle(),
        ":description" => $task->getDescription(),
        ":deadline"    => $task->getDeadline(),
        ":created"     => $task->getCreated(),
        ":status"      => $task->getStatus(),
        ":taskcategoryid" => $task->getCategory()->getId(),
        ":userid"      => $task->getUser()->getId(),
        ":projectid"   => $task->getProject()->getId()
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

  public function update(Task $task){
    try{
      $sql = "UPDATE task SET tk_title = :title, tk_description = :description,tk_completed = :completed, tk_deadline = :deadline, tk_status = :status, task_category_id = :taskcategoryid WHERE user_id = :userid AND project_id = :projectid AND id = :id";

      $params = array(
        ":id"          => $task->getId(),
        ":title"       => $task->getTitle(),
        ":description" => $task->getDescription(),
        ":deadline"    => $task->getDeadline(),
        ":completed"    => $task->getCompleted(),
        ":status"      => $task->getStatus(),
        ":userid"      => $task->getUser()->getId(),
        ":taskcategoryid" => $task->getCategory()->getId(),
        ":projectid"   => $task->getProject()->getId()
      );

      $result = $this->pdo->ExecuteNonQuery($sql, $params);

      if($result)
        return $task->getId();
      else
        return -1;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getById(int $taskId, int $projectId){
    try{
      $sql = "SELECT t.tk_title, t.tk_description, t.tk_deadline, t.tk_status, t.tk_created, t.task_category_id, t.tk_completed, tc.tc_name, u.us_name, u.id as userid FROM task t INNER JOIN user u ON u.id = t.user_id INNER JOIN task_category tc ON tc.id = t.task_category_id WHERE t.project_id = :projectid AND t.id = :taskid";
      $params = array(
        ":projectid" => $projectId,
        ":taskid" => $taskId
      );

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $params);
      return (object)[
        "id" => $taskId,
        "title" => $dr["tk_title"] ?? null,
        "description" => $dr["tk_description"] ?? null,
        "deadline" => $dr["tk_deadline"] ?? null,
        "status" => $dr["tk_status"] ?? null,
        "created" => $dr["tk_created"] ?? null,
        "completed" => $dr["tk_completed"] ?? null,
        "taskCategoryId" => $dr["task_category_id"] ?? null,
        "taskCategoryName" => $dr["tc_name"] ?? null,
        "userid" => $dr["userid"] ?? null,
        "username" => $dr["us_name"] ?? null
      ];
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getAllResumed(int $projectId = 0, $limit = 20, $status = 1){
    try{
      $sql = "SELECT t.id, t.tk_title, t.tk_deadline, t.tk_status, t.tk_created, t.tk_completed, tc.tc_name, u.us_name FROM task t INNER JOIN user u ON u.id = t.user_id INNER JOIN task_category tc ON tc.id = t.task_category_id WHERE t.project_id = :projectid AND t.tk_status = :status ORDER BY t.tk_created DESC LIMIT :limit";
      $params = [
        ":projectid" => $projectId,
        ":limit"     => $limit,
        ":status"    => $status
      ];

      $dt = $this->pdo->ExecuteQuery($sql, $params);
      $list = [];

      foreach($dt as $dr){
        $list[] = (object)[
          "id" => $dr["id"],
          "title" => $dr["tk_title"],
          "deadline" => $dr["tk_deadline"],
          "status" => $dr["tk_status"],
          "created" => $dr["tk_created"],
          "taskCategoryName" => $dr["tc_name"],
          "completed" => $dr["tk_completed"],
          "username" => $dr["us_name"]
        ];
      }

      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getAllByCategoryId(int $projectId, int $taskCategoryId, int $status = 1){
    try{
      $sql = "SELECT t.id, t.tk_title, t.tk_deadline, t.tk_status, t.tk_created, t.tk_completed, tc.tc_name, u.us_name FROM task t INNER JOIN user u ON u.id = t.user_id INNER JOIN task_category tc ON tc.id = t.task_category_id WHERE t.project_id = :projectid AND t.task_category_id = :taskcategoryid AND t.tk_status = :status ORDER BY t.tk_created DESC";
      $params = [
        ":projectid"      => $projectId,
        ":taskcategoryid" => $taskCategoryId,
        ":status"    => $status
      ];

      $dt = $this->pdo->ExecuteQuery($sql, $params);
      $list = [];

      foreach($dt as $dr){
        $list[] = (object)[
          "id" => $dr["id"],
          "title" => $dr["tk_title"],
          "deadline" => $dr["tk_deadline"],
          "status" => $dr["tk_status"],
          "created" => $dr["tk_created"],
          "taskCategoryName" => $dr["tc_name"],
          "completed" => $dr["tk_completed"],
          "username" => $dr["us_name"]
        ];
      }

      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public function getAllMonthTask($projectsId, $dtStart, $dtEnd){
    try{
      $projectsId = filter_var($projectsId, FILTER_SANITIZE_STRING);
      $sql = "SELECT t.tk_title, t.tk_created, t.tk_deadline, p.pr_title as projecttile FROM task t INNER JOIN project p ON p.id = t.project_id WHERE t.tk_status = 1 AND p.pr_status = 1 AND p.id in ({$projectsId}) AND t.tk_deadline between :dtstart AND :dtend";
      $params = array(
        ":dtstart"    => $dtStart,
        ":dtend"      => $dtEnd
      );

      $dt = $this->pdo->ExecuteQuery($sql, $params);
      $list = [];

      foreach($dt as $dr){
        $list[] = [
          "taskTitle" => $dr["tk_title"],
          "taskCreated" => $dr["tk_created"],
          "taskDeadline" => $dr["tk_deadline"],
          "projectTitle" => $dr["projecttile"]
        ];
      }

      return $list;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
