<?php

namespace App\Core;

class Core{

  private $uri;
  private $controller;
  private $method;
  private $headerMethod;
  private $headerHttp;
  private $params = array();

  public function __construct(){
    $this->normalizeUri();
  }

  private function normalizeUri(){
    $explode = str_replace("?", "/", $_SERVER["REQUEST_URI"]);
    $explode = str_replace("#", "/", $explode);
    $explode = explode( "/", $explode);

    for ($i=0; $i < URI_UNLINK_COUNT; $i++) {
      unset($explode[$i]); //Remove index unless
    }

    //Normalize Array
    $explode = array_filter(array_values($explode));
    $this->uri = $explode;

    if(URI_DEBUG){
      debug($explode);
      die();
    }
  }

  public function Run(){
    $this->controller = (isset($this->uri[0]) ? ucfirst($this->uri[0]) . "Controller" : CONTROLLER);
    $this->method = (isset($this->uri[1]) ? $this->uri[1] : METHOD);
    $this->headerMethod = (isset($this->uri[1]) ? "Header" . $this->uri[1] : METHOD_HEADER);
    $this->headerHttp = (isset($this->uri[1]) ? "Http" . $this->uri[1] : METHOD_HTTP);
    $this->params = $this->getParams();

    $dir =  "../App/View/index.php";
    if(file_exists($dir))
      require_once($dir);
    else
      require_once("../App/View/layout/404.html");
  }

  public function RunHttp(){
    $cont  = $this->getController();
    $c  = new $cont();

    if($this->getHeaderHttp($c) != null){

      call_user_func_array(array(
        $c,
        $this->getHeaderHttp($c)
      ), $this->params);
    }
  }

  public function RunHeader(){
    $cont  = $this->getController();
    $c  = new $cont();

    if($this->getHeaderMethod($c) != null){

      call_user_func_array(array(
        $c,
        $this->getHeaderMethod($c)
      ), $this->params);
    }
  }

  public function RunContent(){
    $cont  = $this->getController();
    $c  = new $cont();

    call_user_func_array(array(
      $c,
      $this->getMethod($c)
    ), $this->params);
  }

  public function getArea(){
    return $this->area;
  }

  private function getController(){
    $class = "App\\Controller\\".$this->controller;
    if(class_exists($class))
    return $class;
    else
    return "App\\Controller\\" . CONTROLLER;
  }

  private function getMethod($cont = null){
    if($cont == null)
    $cont = $this->getController();

    if(method_exists($cont, $this->method))
    return $this->method;

    return METHOD;
  }

  private function getHeaderMethod($cont = null){
    if($cont == null)
    $cont = $this->getController();

    if(method_exists($cont, $this->headerMethod))
    return $this->headerMethod;

    return null;
  }

  private function getHeaderHttp($cont = null){
    if($cont == null)
    $cont = $this->getController();

    if(method_exists($cont, $this->headerHttp))
      return $this->headerHttp;

    return null;
  }

  private function getParams(){
    $p = array();

    if(!isset($this->uri[2]))
    return $p;


    for($i = 2; $i < count($this->uri); $i++){
      $p[] = $this->uri[$i];
    }
    return $p;
  }
}

?>
