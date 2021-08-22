<?php
  require 'utils/db_env.php';

  mysqli_report(MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX);
  $dbConn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
  $dbConn->set_charset('utf8mb4');
  $dbConn->query("SET GLOBAL sql_mode = 'TRADITIONAL';");

  $conn =& $dbConn;
?>
