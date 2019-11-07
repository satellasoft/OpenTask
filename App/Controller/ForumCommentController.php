<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\ForumCommentModel;
use App\Entity\ForumComment;

class ForumCommentController extends Controller{

  private $forumCommentModel;

  public function __construct(){
    parent::__construct();

    $this->forumCommentModel = new ForumCommentModel();
  }
  
  public function index(){
    $this->Load("layout/404.php");
  }
}
