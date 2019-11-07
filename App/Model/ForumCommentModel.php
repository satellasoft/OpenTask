<?php
namespace App\Model;
use App\Core\Model;
use App\Entity\ForumComment;

class ForumCommentModel{
  private $pdo;

  public function __construct(){
    $this->pdo = new Model();
  }

  public function store(ForumComment $fc){
    try{
      $sql = "INSERT INTO forum_comment  (fc_content, fc_created, fc_subid, forum_id, user_id) VALUES (:content, :created, :subid, :forumid, :userid)";

      $params = array(
        ":content" => $fc->getContent(),
        ":created" => $fc->getCreated(),
        ":subid"   => $fc->getSubid(),
        ":forumid" => $fc->getForum()->getId(),
        ":userid"  => $fc->getUser()->getId()
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

  function getAllComplete($forumId){
    try{
      $sql = "SELECT f.id, f.fc_content, f.fc_created, f.fc_subid, u.us_name FROM forum_comment f INNER JOIN user u ON u.id = f.user_id WHERE f.forum_id = :forumid ORDER BY f.id DESC";

      $param = array(
        ":forumid" => $forumId
      );

      $dt = $this->pdo->ExecuteQuery($sql, $param);
      $listComment = [];

      foreach($dt as $dr){
        //f.id, f.fc_content, f.fc_created, f.fc_subid, u.us_name
        $listComment[] = (object)array(
          "id" => $dr['id'],
          "content" => $dr['fc_content'],
          "created" => $dr['fc_created'],
          "subid" => $dr['fc_subid'],
          "username" => $dr['us_name']
        );
      }

      return $listComment;
    }catch(PDOException $ex){
      echo $ex->getMessage();
      return null;
    }
  }
}
