<?php

print_r($_POST);
$amount = 0;
include 'include_db_details.php';
$options = [
    'cost' => 12,
];
$query = $con->prepare("INSERT INTO `faculty` VALUES (:id,:username,:password)");

$query->bindParam(":id",$_POST['id'],PDO::PARAM_STR);
$query->bindParam(":username",$_POST['username'],PDO::PARAM_STR);
$query->bindParam(":password",password_hash($_POST['password'],PASSWORD_BCRYPT,$options),PDO::PARAM_STR);

if($query->execute()) {
    echo '<h2>Succesfully Registered</h2>';
}

?>