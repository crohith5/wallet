<?php
session_start();
if(!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}
ksort($_POST);
include 'include_db_details.php';
$exam_name = $_POST['exam_id'];
$regulation = $_POST['regulation'];
$branch = $_POST['branch'];
$semester = $_POST['semester'];
$num_subjects = $_POST['num_subjects'];

$amounts = array();
$sub_names = array();

foreach($_POST as $key => $value) {
    if(preg_match('/^subject_/',$key)) {
        $sub_names[$key] = $value;
    }
    else if(preg_match('/^amount_subjects_/',$key)) {
        $amounts[$key] = $value;
    }
}
$amounts = implode(',',$amounts);
$sub_names = implode(',', $sub_names);

$query = $con->prepare("INSERT INTO `supply_exams` (`name`,`regulation`,`branch`,`semester`,`num_subjects`,`sub_names`,`amounts`) VALUES ('$exam_name','$regulation','$branch','$semester','$num_subjects','$sub_names','$amounts')");



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
