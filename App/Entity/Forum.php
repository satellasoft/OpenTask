<?php
namespace App\Entity;

use App\Entity\Task;
use App\Entity\User;

class Forum{

	private $id;
	private $title;
	private $content;
	private $created;
	private $task;
	private $user;

	//Constructor
  public function __construct(){
    $this->task = new Task();
    $this->user = new User();
  }

	//Setters
	public function setId($id){
		$this->id = $id;
	}

	public function setTitle($Title){
		$this->title = $Title;
	}

	public function setContent($Content){
		$this->content = $Content;
	}

	public function setCreated($Created){
		$this->created = $Created;
	}

	public function setTask($Task){
		$this->task = $Task;
	}

	public function setUser($User){
		$this->user = $User;
	}


	//Getter
	public function getId(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getContent(){
		return $this->content;
	}

	public function getCreated(){
		return $this->created;
	}

	public function getTask(){
		return $this->task;
	}

	public function getUser(){
		return $this->user;
	}

}
