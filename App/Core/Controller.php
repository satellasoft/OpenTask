<?php
namespace App\Core;

class Controller{

  protected function Load(string $view, $params = array()){
    extract($params);
    require_once("../App/View/" . $view);
  }
}
?>
