<?php
/*
Return current DateTime
*/
function getCurrentDate(string $format = "Y-m-d H:i:s"){
  return date($format);
}

function convertDate($date, string $format = "d/m/Y H:i:s"){
  return date($format, strtotime($date));
}

function passwordHash($pass){
  return password_hash($pass, PASSWORD_DEFAULT);
}

function calculateDatePercentage($date1, $date2){
  $date1 = new Datetime($date1);
  $date2 = new Datetime($date2);
  $currentDate = new Datetime(getCurrentDate());

    $totalTime = $date1->diff($date2)->format('%a');
    $completeTime = $date1->diff($currentDate)->format('%a');

    $t = round(($totalTime - $completeTime) / $totalTime, 2) * 100;
    return (100 - $t < 100 ? 100 - $t : 100);
}

//Show debug element
function debug($element){
  echo "<pre>";
  print_r($element);
  echo "</pre>";
}

function redirect($url){
  echo "<script>document.location.href='{$url}';</script>";
}

?>
