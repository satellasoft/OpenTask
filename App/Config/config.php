<?php

define("BASE", "/opentask/");

//URI CONTROLLER
define("URI_UNLINK_COUNT", 2);
define("URI_DEBUG", false);//change to false after test

//DATABASE
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "opentask");

define("DEFAULT_USER_PASS", "A123456Z");

define("DATE_FORMAT", "d/m/Y");
define("DATETIME_FORMAT", "d/m/Y H:i:s");
define("TIMEZONE", "America/Sao_Paulo");

//MODEL DEFAULT VALUES
define("CONTROLLER", "HomeController");
define("METHOD", "index");
define("METHOD_HEADER", "Headerindex");//call inner <head></head>
define("METHOD_HTTP", "Httpindex");//call befrore <!doctype>
