<?php
include 'include_db_details.php';
$username = $_POST['username'];
$password = $_POST['password'];

// $options = [
//     'cost' => 12,
// ];
// print(password_hash("12345678",PASSWORD_BCRYPT,$options)).'\n';
$query = $con->prepare("SELECT password,username FROM admin WHERE username='$username'");
$query->execute();
$results = $query->fetch(PDO::FETCH_NUM);
if(empty($results)) {
    echo '<h2>No User with that username</h2>';
    exit();
}
$password_hash = $results[0];
$id = $results[1];

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if(password_verify($password,$password_hash)) {
    session_start();
    $_SESSION['admin'] = $username;
    redirect('admin_home.php');
}
else {
    echo "<script>alert('Incorrect Password')</script>";
}

?>
