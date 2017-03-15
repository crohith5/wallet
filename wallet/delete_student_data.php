<?php
session_start();
if(!isset($_SESSION['admin'])) {
    echo "You don't have permission";
    exit();
}
include 'include_db_details.php';
$rollno = $_POST['rollno'];
$query = $con->prepare("DELETE FROM `student` WHERE `rollno`='$rollno'");

if($query->execute()) {
    echo 'Deleted Successfully';
}
else {
    echo 'Could not delete the student. Try again!';
}

?>