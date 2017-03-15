<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    echo "You don't have permission";
    exit();
}

include 'include_db_details.php';
$branch = $_POST['branch'];
$semester = $_POST['semester'];
$regulation = $_POST['regulation'];
$reg_or_sup = $_POST['reg_or_sup'];


function flatten($a) {
    $flattened = [];
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($a));
    foreach($it as $v) {
        $flattened[] = $v;
    }
    return $flattened;
}


if($reg_or_sup == 'reg') {
    $query = $con->prepare("SELECT `name` FROM `regular_exams` WHERE `regulation`=:regulation AND `semester`=:semester");
    $query->bindParam(':regulation',$regulation,PDO::PARAM_STR);
    $query->bindParam(':semester',$semester,PDO::PARAM_STR);
    if($query->execute()) {
        $results = $query->fetchAll(PDO::FETCH_NUM);
        echo json_encode(flatten($results));
    }
}
else if($reg_or_sup = 'sup') {
    $query = $con->prepare("SELECT `name` FROM `supply_exams` WHERE `regulation`=:regulation AND `semester`=:semester AND `branch`=:branch");
    $query->bindParam(':regulation',$regulation,PDO::PARAM_STR);
    $query->bindParam(':semester',$semester,PDO::PARAM_STR);
    $query->bindParam(':branch',$branch,PDO::PARAM_STR);
    if($query->execute()) {
        $results = $query->fetchAll(PDO::FETCH_NUM);
        echo json_encode(flatten($results));
    }
}


?>