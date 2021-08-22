<?php
  require 'utils/db_env.php';

  $dbConn = new PDO("mysql: host=$dbHost; dbname=$dbName; charset=utf8mb4;", $dbUser, $dbPass);
  $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbConn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
  $dbConn->exec("SET GLOBAL sql_mode = 'TRADITIONAL';");

  $conn =& $dbConn;
?>
