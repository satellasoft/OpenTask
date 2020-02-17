<?php
namespace App\Entity;
use App\Entity\Project;
use App\Entity\User;

class Task{

	private $id;
	private $title;
	private $description;
	private $deadline;
	private $created;
	private $completed;
	private $status;
	private $user;
	private $project;

  public function __construct(){
    $this->user    = new User();
    $this->project = new Project();
  }

	public function setId($id){
		$this->id = $id;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setDeadline($deadline){
		$this->deadline = $deadline;
	}

	public function setCreated($created){
		$this->created = $created;
	}

	public function setCompleted($completed){
		$this->completed = $completed;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function setProject($project){
		$this->project = $project;
	}

	public function getId(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getDeadline(){
		return $this->deadline;
	}

	public function getCreated(){
		return $this->created;
	}

	public function getCompleted(){
		return $this->completed;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getUser(){
		return $this->user;
	}

	public function getProject(){
		return $this->project;
	}
}
