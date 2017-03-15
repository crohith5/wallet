<?php
include 'include_db_details.php';
$rollno = strtoupper($_POST['rollno']);
$password = $_POST['password'];

// $options = [
//     'cost' => 12,
// ];
// print(password_hash("12345678",PASSWORD_BCRYPT,$options)).'\n';
$query = $con->prepare("SELECT `password`,`rollno`,`name` FROM `student` WHERE `rollno`='$rollno'");
$query->execute();
$results = $query->fetch(PDO::FETCH_NUM);
if(empty($results)) {
    echo '<h2>No User with that username</h2>';
    exit();
}
$password_hash = $results[0];
$id = $results[1];
$name = $results[2];

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if(password_verify($password,$password_hash)) {
    session_start();
    $_SESSION['student_id'] = $id;
    $_SESSION['student_name'] = $name;
    redirect('student_home.php');
}
else {
    echo "<script>alert('Incorrect Password')</script>";
}

?>
