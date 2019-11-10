<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../../vendor/autoload.php");
require_once("../../App/Config/config.php");
require_once("../../App/Function/functions.php");
date_default_timezone_set(TIMEZONE);

$req = filter_input(INPUT_GET, "r", FILTER_SANITIZE_NUMBER_INT);

switch ($req) {
  case 1:
    $taskModel = (new \App\Model\TaskModel());
    $strIds = filter_input(INPUT_POST, "strIds", FILTER_SANITIZE_STRING);
    $totalDays = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y")); // 31
    $last = date("Y-m-") . $totalDays; //return last day from currentMonth

    $tasks = $taskModel->getAllMonthTask($strIds, date("Y-m-d"), $last);

    echo json_encode($tasks);
    break;

    case 2:
    echo json_encode(['result' =>'TRESTEETETET']);
    break;

  default:
    echo json_encode(['result' => 'invalid request']);
    break;
}
?>
