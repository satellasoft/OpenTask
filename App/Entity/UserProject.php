<?php
namespace App\Entity;
use App\Entity\User;
use App\Entity\Project;

class UserProject{
  private $user;
  private $project;
  private $position;
  private $status;

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

  public function setPosition($position){
    $this->position = $position;
  }

  public function getPosition(){
    return $this->position;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getStatus(){
    return $this->status;
  }
}
