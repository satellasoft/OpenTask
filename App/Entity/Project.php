<?php
namespace App\Entity;

class Project{

	private $id;
	private $title;
	private $description;
	private $deadline;
	private $created;
	private $status;
	private $userID;


	//Setters
	public function setId($Id){
		$this->id = $Id;
	}

	public function setTitle($Title){
		$this->title = $Title;
	}

	public function setDescription($Description){
		$this->description = $Description;
	}

	public function setDeadline($Deadline){
		$this->deadline = $Deadline;
	}

	public function setCreated($Created){
		$this->created = $Created;
	}

	public function setStatus($Status){
		$this->status = $Status;
	}

	public function setUserID($UserID){
		$this->userID = $UserID;
	}


	//Getter
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

	public function getStatus(){
		return $this->status;
	}

	public function getUserID(){
		return $this->userID;
	}


}
