<?php
namespace App\Entity;

class User{
  private $id;
  private $name;
  private $email;
  private $login;
  private $password;
  private $permission;
  private $status;
  private $register;

  //Constructor
  public function __construct ($id = 0, $name = '', $email = '', $login = '', $password = '', $permission = '', $status = '', $register = ''){
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->login = $login;
    $this->password = $password;
    $this->permission = $permission;
    $this->status = $status;
    $this->register = $register;
  }
  //Setters
  public function setId($id){
    $this->id = $id;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function setEmail($email){
    $this->email = trim(strtolower($email));
  }

  public function setLogin($login){
    $this->login = trim(strtolower($login));
  }

  public function setPassword($password){
    $this->password = $password;
  }

  public function setPermission($permission){
    $this->permission = $permission;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function setRegister($register){
    $this->register = $register;
  }

  //Getter
  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getEmail(){
    return $this->email;
  }

  public function getLogin(){
    return $this->login;
  }

  public function getPassword(){
    return $this->password;
  }

  public function getPermission(){
    return $this->permission;
  }

  public function getStatus(){
    return $this->status;
  }

  public function getRegister(){
    return $this->register;
  }
}
?>
