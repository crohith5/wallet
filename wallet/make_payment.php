<?php
session_start();
if(!isset($_SESSION['student_id'])) {
    echo "You don't have permission";
    exit();
}
//Array ( [exam_id] => 2-2 regular r17 [s_id] => 134G1A0565 [type] => reg [subjects] => All [amount] => 750 )
$results = [];
include 'include_db_details.php';
$amountToDeduct = $_POST['amount'];
$f_id = 20;
$rollno = $_POST['s_id'];
$subjects = $_POST['subjects'];
$exam_id = $_POST['exam_id'];
$type = $_POST['type'];
$is_regular = $_POST['type'] == 'reg' ? 1 : 0;
$branch = $_POST['branch'];
if($is_regular) {
    $query = $con->prepare('SELECT amount from `regular_exams` WHERE `name`=:name');
    $query->bindParam(':name', $exam_id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_NUM);
    $amountToDeduct = $results[0];
}
else if($_POST['type'] == 'sup') {
    $num_subjects = $_POST['num_subjects'];
    $query = $con->prepare("SELECT `amounts` FROM `supply_exams` WHERE `name`=:name");
    $query->bindParam(':name',$exam_id,PDO::PARAM_STR);
    $query->execute();
    $sup_exam_details = $query->fetchAll(PDO::FETCH_ASSOC);
    $sup_exam_details = $sup_exam_details[0];
    $amounts = explode(",",$sup_exam_details['amounts']);
    $amounts = array_map('intval', $amounts);
    array_unshift($amounts,0);
    $amountToDeduct = $amounts[$num_subjects];
}
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if(!ctype_digit($amountToDeduct)) {
    redirect('student_home.php?errormsg=Inavlid Amount');
    exit();
}

$date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
$date = $date->format('Y-m-d H:i:s');

$sql['debit_amount']  = "UPDATE student SET amount= CASE WHEN amount >= $amountToDeduct THEN amount - $amountToDeduct ELSE amount END WHERE rollno='$rollno'";
$sql['insert_into_transactions'] = "INSERT INTO transactions (`f_id`,`s_id`,`is_debited`,`amount`,`datetime`,`reason`) VALUES ('$f_id','$rollno',1,$amountToDeduct,'$date','Rs.$amountToDeduct debited from $rollno for $exam_id')";
$query = $con->prepare("INSERT INTO exam_transactions (`exam_id`,`s_id`,`is_regular`,`subjects`,`amount`,`datetime`,`t_id`) VALUES ('$exam_id','$rollno',$is_regular,'$subjects','$amountToDeduct','$date',:t_id)");

$con->beginTransaction();

try
{
    foreach($sql as $stmt_name => &$sql_command)
    {
        $stmt[$stmt_name] = $con->prepare($sql_command);
    }

    $stmt['debit_amount']->execute();
    $stmt['insert_into_transactions']->execute();
    $t_id = $con->lastInsertId();
    $query->bindParam(':t_id',$t_id,PDO::PARAM_INT);
    $query->execute();
    $con->commit();
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        #recepit-body {
            -webkit-box-shadow: 4px 2px 2px 5px black;
            -moz-box-shadow: 4px 2px 2px 5px black;
            box-shadow: 4px 2px 2px 5px black;
            min-height: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <img class="img img-responsive center-block" id="faclogo" src="images/logo.png" alt="">
        </div>
        <div class="row">
            <div class="col-xs-6 col-xs-push-3" id="recepit-body">
                <br />
                <div class="text-left col-xs-6">
                    <p><strong>S.No:</strong> <?php echo $t_id;?></p>
                </div>
                <div class="text-right col-xs-6">
                    <p><strong>Date:</strong> <?php echo $date;?></p>
                </div>
                <div class="text-left col-xs-6">
                    <p><strong>Name:</strong> <?php echo $_SESSION['student_name'];?></p>
                    <p><strong>Roll No:</strong> <?php echo $_SESSION['student_id'];?></p>
                    <p><strong>Branch:</strong> <?php echo $branch;?></p>
                    <p><strong>Subjects:</strong> <?php echo $subjects;?></p>
                    <p><strong>Amount:</strong> Rs. <?php echo $amountToDeduct;?>/-</p>
                    <p><strong>Exam:</strong> <?php echo $exam_id;?></p>
                </div>
            </div>
        </div>
        <br />
        <div class="text-center">
            <a href="student_home.php" class="hidden-print btn btn-primary">Go Back</a>
        </div>
    </div>
</body>
</html>
<?php
}
catch(PDOException $e)
{
    $results['error'] = $e->getMessage();
    redirect('student_home.php?errormsg=You have already paid or there was an error contact examsection.');
    $con->rollBack();
}
?>
