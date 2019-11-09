<?php

namespace App\Controller;
use App\Core\Controller;

class LoginController extends Controller{

  public function __construct(){
    parent::__construct(false);
  }

  public function index(){
    if($GLOBALS["logged"]){
      redirect(BASE);
    }

    $this->Load("login/login.php");
  }

  public function Headerindex(){
    echo "<title>Login - Open Task</title>";
  }
  
  public function logout(){
    session_destroy();
    redirect(BASE);
  }


  public function auth(){
    $login    = filter_input(INPUT_POST, "txtUsername", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "txtPassword", FILTER_SANITIZE_STRING);
    $login = strtolower($login);
    $login = trim($login);


    if(strlen($password) >= 7 && strlen($login) >= 7 && strpos($login, ".") > 0){

      $userModel = (new \App\Model\UserModel());

      $hash = $userModel->getPasswaordHash($login);
      if(password_verify($password, $hash)){
        $user =$userModel->getResumeLogin($login);
        $_SESSION["i"] = $user->id;
        $_SESSION["p"] = $user->permission;

        $name = explode(" ", $user->name);
        $_SESSION["n"] = $name[0];
        redirect(BASE);
      }else{
        $this->Load("login/auth.php", ["msg" => "Login ou senha inválidos"]);
      }
    }

  }
}
?>
