<?php
session_start();
if(!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}
include 'include_db_details.php';
$exam_name = $_POST['name'];
$query = $con->prepare("DELETE FROM `regular_exams` WHERE `name`='$exam_name'");

if($query->execute()) {
    echo 'Deleted Successfully';
}
else {
    echo 'Could not delete the exam. Try again!';
}

?>
