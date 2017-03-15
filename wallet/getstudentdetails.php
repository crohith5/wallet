<?php
session_start();
if(!isset($_SESSION['faculty'])) {
  echo "You don't have permission";
  exit();
}

include 'include_db_details.php';
$roll = $_POST['id'];
$query = $con->prepare("SELECT name,branch,amount,rollno FROM student WHERE rollno='$roll'");
$query->execute();
$results = $query->fetch(PDO::FETCH_ASSOC);

echo json_encode($results);

?>
