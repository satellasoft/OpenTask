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

//DEFAULT PASSWORD ON RESET
define("DEFAULT_USER_PASS", "A123456Z");

//DATETIME
define("DATE_FORMAT", "d/m/Y");
define("DATETIME_FORMAT", "d/m/Y H:i:s");
define("TIMEZONE", "America/Sao_Paulo");

//MODEL DEFAULT VALUES
define("CONTROLLER", "HomeController");
define("METHOD", "index");
define("METHOD_HEADER", "Headerindex");//call inner <head></head>
define("METHOD_HTTP", "Httpindex");//call befrore <!doctype>

//UPLOAD
define("FILE_PATH", "resources/files");
define("IMAGE_PATH", "resources/images");
define("MAX_FILE_SIZE", 50); //MB
define("MAX_IMAGE_SIZE", 1);//MB
define("ACCEPT_FORMAT", [
  "image/gif",
  "image/jpeg",
  "image/png",
  "application",
  "application",
  "application/zip",
  "application/x-7z-compressed",
  "application/x-zip-compressed"
]);
define("RENAME_FILE", true);
