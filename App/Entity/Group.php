<?php
namespace App\Entity;
use App\Entity\User;
use App\Entity\Project;

class Group{
  private $user;
  private $project;

  public function __construct(){
    $this->user = new User();
    $this->project = new Project();
  }

  public function setUser($user){
    $this->user = $user;
  }

  public function getUser(){
    return $this->user;
  }

  public function setProject($project){
    $this->project = $project;
  }

  public function getProject(){
    return $this->project;
  }
}
