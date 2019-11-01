<?php
namespace App\Core;

class Controller{
  public function __construct($protectedLogin = true){
    if($protectedLogin && !$GLOBALS["logged"]){
      header("Location: " . BASE . "login/");
    }
  }

  protected function Load(string $view, $params = array()){
    extract($params);
    require_once("../App/View/" . $view);
  }

  protected function protectMethod(){
    if($_SESSION["p"] != 1)
    {
      $this->denied();
      die();
    }
  }

  protected function notFound(){
    $this->Load("layout/404.php");
  }

  protected function denied(){
    $this->Load("layout/denied.php");
  }
}
?>
