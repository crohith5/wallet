<?php
session_start();
if(!isset($_SESSION['faculty'])) {
  echo "You don't have permission";
  exit();
}
$results = [];
include 'include_db_details.php';
$amountToAdd = $_POST['amount'];
$rollno = $_POST['id'];
$f_id = $_SESSION['f_id'];

if(!ctype_digit($amountToAdd)) {
  echo "Invalid Amount";
  exit();
}


$date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
$date = $date->format('Y-m-d H:i:s');

$sql['add_amount']  = "UPDATE student SET amount=amount + $amountToAdd WHERE rollno='$rollno'";
$sql['insert_into_transactions'] = "INSERT INTO transactions (`f_id`,`s_id`,`is_debited`,`amount`,`datetime`,`reason`) VALUES ('$f_id','$rollno',0,$amountToAdd,'$date','Rs.$amountToAdd credited to $rollno')";
$sql['data_to_return'] = "SELECT name,branch,amount,rollno FROM student WHERE rollno='$rollno'";

$con->beginTransaction();

try
{
    foreach($sql as $stmt_name => &$sql_command)
    {
        $stmt[$stmt_name] = $con->prepare($sql_command);
    }

    $stmt['add_amount']->execute();
    $stmt['insert_into_transactions']->execute();
    $stmt['data_to_return']->execute();
    $results = $stmt['data_to_return']->fetch(PDO::FETCH_ASSOC);
    $con->commit();
}
catch(PDOException $e)
{
    $results['error'] = $e->getMessage();
    $con->rollBack();
}
echo json_encode($results);

?>

