<?php

//print_r($_POST['rollno'][2]);
$amount = 0;
include 'include_db_details.php';
 $options = [
     'cost' => 12,
 ];
if($_POST['rollno'][2] == "4" && $_POST['rollno'][3] == "g" && $_POST['rollno'][5] == "a"){

    $query = $con->prepare("INSERT INTO `student` VALUES (:rollno,:name,:branch,:regulation,:email,:amount,:password)");

    $query->bindParam(":rollno",strtoupper($_POST['rollno']),PDO::PARAM_STR);
    $query->bindParam(":name",$_POST['name'],PDO::PARAM_STR);
    $query->bindParam(":branch",$_POST['branch'],PDO::PARAM_STR);
    $query->bindParam(":regulation",$_POST['regulation'],PDO::PARAM_STR);
    $query->bindParam(":email",$_POST['email'],PDO::PARAM_STR);
    $query->bindParam(":amount",$amount,PDO::PARAM_INT);
    $query->bindParam(":password",password_hash($_POST['password'],PASSWORD_BCRYPT,$options),PDO::PARAM_STR);
    if($query->execute()) {
        echo '<h2>Succesfully Registered</h2><a href="student_login.php" >Click here to go Login</a> ';
    }
}

else
    echo '<h2>Not Registered, Roll number not valid</h2><a href="student_register.php" >Click here to go Login</a> ';
?>
