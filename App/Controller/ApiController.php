<?php

namespace App\Controller;

class ApiController{

  public function __construct(){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");//Accpt only GET REQUEST
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  }

  public function index(){
    exit(json_encode(["message" => "Invalid URL"]));
  }

  public function Httpcalendar($strIds = ""){
    $strIds = filter_var($strIds, FILTER_SANITIZE_STRING);

    if(strlen($strIds) <= 0){
      exit(json_encode(["message" => "Invalid ID"]));
    }

    if(substr($strIds, -1) == ","){
      $strIds = substr($strIds, 0, -1);
    }

    $taskModel = (new \App\Model\TaskModel());
    $totalDays = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); // 31
    $last = date("Y-m-") . $totalDays; //return last day from currentMonth

    $tasks = $taskModel->getAllMonthTask($strIds, date("Y-m-d"), $last);

    exit(json_encode($tasks));
  }

}
