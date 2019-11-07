<?php
namespace App\Entity;

use App\Entity\Forum;
use App\Entity\User;

class ForumComment{

	private $id;
	private $content;
	private $created;
	private $subid;
	private $forum;
	private $user;

	//Constructor
  public function __construct(){
    $this->forum = new Forum();
    $this->user = new User();
  }

	//Setters
	public function setId($Id){
		$this->id = $Id;
	}

	public function setContent($Content){
		$this->content = $Content;
	}

	public function setCreated($Created){
		$this->created = $Created;
	}

	public function setSubid($Subid){
		$this->subid = $Subid;
	}

	public function setForum($Forum){
		$this->forum = $Forum;
	}

	public function setUser($User){
		$this->user = $User;
	}


	//Getter
	public function getId(){
		return $this->id;
	}

	public function getContent(){
		return $this->content;
	}

	public function getCreated(){
		return $this->created;
	}

	public function getSubid(){
		return $this->subid;
	}

	public function getForum(){
		return $this->forum;
	}

	public function getUser(){
		return $this->user;
	}

}
