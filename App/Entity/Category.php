<?php

namespace App\Entity;
use App\Entity\Project;

class Category{

	private $id;
	private $name;
	private $register;
	private $project;

	public function __construct ($id = null, $name = '', $register = null, $project = null){
		$this->id = $id;
		$this->name = $name;
		$this->register = $register;
		$this->project = ($project != null ? $project : (new Project()));
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setRegister($register){
		$this->register = $register;
	}

	public function setProject($project){
		$this->project = $project;
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getRegister(){
		return $this->register;
	}

	public function getProject(){
		return $this->project;
	}


}
