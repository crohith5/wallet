<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "wallet";

$con = new PDO("mysql:host=$db_hostname",$db_username,$db_password);
$query = $con->prepare("CREATE DATABASE IF NOT EXISTS $dbname");
$query->execute();
$query = $con->prepare("USE $dbname");
$query->execute();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 ?>
