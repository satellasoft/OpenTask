<?php
require_once("../vendor/autoload.php");
require_once("../App/Config/config.php");
require_once("../App/Function/functions.php");
//Sessions
session_start();

$logged = false;
if(isset($_SESSION["i"]))
  $logged = true;
$GLOBALS["logged"] = $logged;

$core = new App\Core\Core();
$core->Run();
