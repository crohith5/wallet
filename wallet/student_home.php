<?php
session_start();
if(!isset($_SESSION['student_id'])) {
    echo "You don't have permission";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>

    </style>
</head>
<body>
<?php
include 'student_header.php';
?>
<?php
if(array_key_exists('infomsg',$_GET)) {
    printf("<div class='alert alert-success'>
                %s
            </div>",$_GET['infomsg']);
}
if(array_key_exists('errormsg',$_GET)) {
    printf("<div class='alert alert-danger'>
                    %s
                </div>",$_GET['errormsg']);
}
?>
<?php

    include 'include_db_details.php';
    $query = $con->prepare("SELECT `rollno`,`name`,`branch`,`amount`,`regulation` FROM `student` WHERE `rollno`=:rollno");
    $query->bindParam(':rollno',$_SESSION['student_id'],PDO::PARAM_STR);
    if($query->execute()) {
        $results = $query->fetch(PDO::FETCH_ASSOC);
    }
?>
<div class="row">
    <div class="col-md-6 col-md-push-3 text-center">
        <h4>Wallet Details</h4>
        <table class="table table-bordered" id="studentdetailstable">
            <tr>
                <td>ID</td>
                <td id="studentroll"><?php echo $results['rollno']; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td id="studentname"><?php echo $results['name']; ?></td>
            </tr>
            <tr>
                <td>Branch</td>
                <td id="studentbranch"><?php echo $results['branch']; ?></td>
            </tr>
            <tr>
                <td>Regulation</td>
                <td id="studentregulation"><?php echo $results['regulation']; ?></td>
            </tr>
            <tr>
                <td>Amount in Wallet</td>
                <td id="studentwalletamount"><?php echo $results['amount']; ?></td>
            </tr>
        </table>
    </div>
</div>
<!-- Put some content here -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".alert").delay(2000).slideUp(200, function() {
            $(this).alert('close');
        });
    });
</script>
</body>
</html>
