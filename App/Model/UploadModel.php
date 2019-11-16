<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\Upload;

class UploadModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(Upload $upload){
    try{
      $sql = "INSERT INTO file (fl_title, fl_file, fl_type, task_id, user_id) VALUES (:title, :file, :type, :taskid, :userid)";
      //:title, :file, :type, :taskid, :userid
      $params = array(
        ":title"   => $upload->getTitle(),
        ":file"    => $upload->getFile(),
        ":type"    => $upload->getType(),
        ":userid"  => $upload->getUser()->getId(),
        ":taskid"  => $upload->getTask()->getId()
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


  public function getAllByTaskId(int $taskId){
    try{
      $sql = "SELECT f.id, f.fl_title, f.fl_file, f.fl_type, u.id as userid, u.us_name FROM file f INNER JOIN user u ON u.id = f.user_id WHERE f.task_id = :taskid ORDER BY f.id DESC";
      $param = [":taskid" => $taskId];

      $dt = $this->pdo->ExecuteQuery($sql, $param);
      $listUpload = [];

      foreach($dt as $dr){
        $listUpload[] = (object)[
          "fileId"    => $dr["id"],
          "title"     => $dr["fl_title"],
          "file"      => $dr["fl_file"],
          "type"      => $dr["fl_type"],
          "userName"  => $dr["us_name"],
          "userId"    => $dr["userid"]
        ];
      }

      return $listUpload;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  function remove(int $fileId, int $userId){
    try{
      $sql = "DELETE FROM file WHERE id = :fileid AND user_id = :userid";
      $params = [
        ":fileid" => $fileId,
        ":userid" => $userId,
      ];

      return $this->pdo->ExecuteNonQuery($sql, $params);
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return false;
    }
  }

  public function getResumeFileById(int $fileId){
    try{
      $sql = "SELECT fl_file, fl_type, user_id FROM file WHERE id = :fileid";
      $param = [
        ":fileid" => $fileId
      ];

      $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
      return (object)[
        "file" => $dr["fl_file"],
        "type" => $dr["fl_type"],
        "userId" => $dr["user_id"],
      ];
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
