<?php
namespace App\Entity;
use App\Entity\User;
use App\Entity\Task;

class Upload{

	private $id;
	private $title;
	private $file;
	private $type;
	private $task;
	private $user;

  public function __construct(){
    $this->user = new User();
    $this->task = new Task();
  }

	//Setters
	public function setId($Id){
		$this->id = $Id;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setFile($file){
		$this->file = $file;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setTask($task){
		$this->task = $task;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function getId(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getFile(){
		return $this->file;
	}

	public function getType(){
		return $this->type;
	}

	public function getTask(){
		return $this->task;
	}

	public function getUser(){
		return $this->user;
	}
}
