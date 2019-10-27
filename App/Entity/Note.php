<?php
namespace App\Entity;
use App\Entity\Project;
use App\Entity\User;

class Note{

  private $id;
  private $title;
  private $created;
  private $content;
  private $color;
  private $status;
  private $project;
  private $user;

  public function __construct(){
    $this->project = new Project();
    $this->user = new User();
  }

  public function setId($id){
    $this->id = $id;
  }

  public function setTitle($title){
    $this->title = $title;
  }

  public function setCreated($created){
    $this->created = $created;
  }

  public function setContent($content){
    $this->content = $content;
  }

  public function setColor($color){
    $this->color = $color;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function setProject($project){
    $this->project = $project;
  }

  public function setUser($user){
    $this->user = $useruser;
  }

  public function getId(){
    return $this->id;
  }

  public function getTitle(){
    return $this->title;
  }

  public function getCreated(){
    return $this->created;
  }

  public function getContent(){
    return $this->content;
  }

  public function getColor(){
    return $this->color;
  }

  public function getStatus(){
    return $this->status;
  }

  public function getProject(){
    return $this->project;
  }

  public function getUser(){
    return $this->user;
  }
}
