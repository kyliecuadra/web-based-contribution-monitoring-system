<?php 
require ("config/db_connection.php");
session_start();


session_unset();
session_destroy();
header("location: index.php");

?>