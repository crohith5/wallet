<?php
session_start();
if(!isset($_SESSION['admin'])) {
    echo "You don't have permission";
    exit();
}
include 'include_db_details.php';
$exam_name = $_POST['id'];
$query = $con->prepare("DELETE FROM `faculty` WHERE `id`='$exam_name'");

if($query->execute()) {
    echo 'Deleted Successfully';
}
else {
    echo 'Could not delete the exam. Try again!';
}

?>