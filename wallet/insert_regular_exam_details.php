<?php
session_start();
if(!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}
include 'include_db_details.php';
$exam_name = strtoupper($_POST['exam_id']);
$regulation = strtoupper($_POST['regulation']);
$semester = strtoupper($_POST['semester']);
$amount = strtoupper($_POST['amount']);

$query = $con->prepare("INSERT INTO `regular_exams` (`name`,`regulation`,`semester`,`amount`) VALUES ('$exam_name','$regulation','$semester','$amount')");

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if ($query->execute()) {
    redirect("examsection_home.php?infomsg=Exam Added Successfully");
} else {
    redirect("examsection_home.php?errormsg=Error adding exam");
}

?>
