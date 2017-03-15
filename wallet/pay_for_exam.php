<?php

session_start();
if (!isset($_SESSION['student_id'])) {
    echo "You don't have permission";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
    <style>
    </style>
</head>
<body>

<?php
include 'student_header.php';
$branch = $_POST['branch'];
$semester = $_POST['semester'];
$regulation = $_POST['regulation'];
$reg_or_sup = $_POST['type'];
$exam = $_POST['exam'];
$s_id = $_SESSION['student_id'];
include 'include_db_details.php';

if($reg_or_sup == 'reg') {
    $query = $con->prepare("SELECT * FROM `regular_exams` WHERE `name`=:name");
    $query->bindParam(':name',$exam,PDO::PARAM_STR);
    $query->execute();
    $reg_exam_details = $query->fetchAll(PDO::FETCH_ASSOC);
    $reg_exam_details = $reg_exam_details[0];
    ?>
    <div class="container text-center">
        <form action="make_payment.php" method="POST">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Exam ID</th>
                    <td><?php echo $exam;?></td>
                </tr>
                <tr>
                    <th>Student ID</th>
                    <td><?php echo $s_id;?></td>
                </tr>
                <tr>
                    <th>Regulation</th>
                    <td><?php echo $regulation;?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td><?php echo $semester;?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td><?php echo $reg_exam_details['amount']; ?></td>
                </tr>
                </tbody>
            </table>
            <input type="hidden" name="exam_id" value="<?php echo $exam;?>"/>
            <input type="hidden" name="s_id" value="<?php echo $s_id;?>"/>
            <input type="hidden" name="type" value="<?php echo $reg_or_sup;?>"/>
            <input type="hidden" name="branch" value="<?php echo $branch;?>"/>
            <input type="hidden" name="subjects" value="<?php echo 'All';?>"/>
            <input type="hidden" name="amount" value="<?php echo $reg_exam_details['amount'];?>"/>
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
    </div>
<?php
}

else if($reg_or_sup == 'sup') {
        $query = $con->prepare("SELECT * FROM `supply_exams` WHERE `name`=:name");
        $query->bindParam(':name',$exam,PDO::PARAM_STR);
        $query->execute();
        $sup_exam_details = $query->fetchAll(PDO::FETCH_ASSOC);
        $sup_exam_details = $sup_exam_details[0];
        $subs = explode(",",$sup_exam_details['sub_names']);
        $amounts = explode(",",$sup_exam_details['amounts']);
    ?>
    <div class="container text-center">
        <form action="make_payment.php" method="POST">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>Exam ID</th>
                    <td><?php echo $exam;?></td>
                </tr>
                <tr>
                    <th>Student ID</th>
                    <td><?php echo $s_id;?></td>
                </tr>
                <tr>
                    <th>Regulation</th>
                    <td><?php echo $regulation;?></td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td><?php echo $semester;?></td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-4 col-xs-push-5 text-left">
                    <?php
                        $i = 0;
                        foreach($subs as $s) {
                            printf("<div class=\"checkbox\">
                                  <label><input name='subject_%d' class='subject' type=\"checkbox\" value=\"\">%s</label>
                                </div>",$i,$s);
                            $i++;
                        }
                    ?>
                    <p><strong>Amount: </strong> <span id="amountToPay">0</span></p>
                </div>
            </div>
            <input type="hidden" name="exam_id" value="<?php echo $exam;?>"/>
            <input type="hidden" name="s_id" value="<?php echo $s_id;?>"/>
            <input type="hidden" name="type" value="<?php echo $reg_or_sup;?>"/>
            <input type="hidden" name="branch" value="<?php echo $branch;?>"/>
            <input type="hidden" name="subjects" id="subjects" value=""/>
            <input type="hidden" name="num_subjects" id="num_subjects" value=""/>
            <input type="hidden" name="amount" value="0"/>
            <button id="pay-button" class="btn btn-success" disabled="disabled">Pay</button>
        </form>
    </div>
<?php
}

?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        var amounts = <?php echo json_encode($amounts); ?>;
        amounts.unshift(0);
        var count = 0;
        function getSelectedSubjects() {
            var subjects = [];
            count = 0;
            var checked_subjects = $('.subject:checked');
            checked_subjects.each(function() {
                subjects.push($(this).parent().text());
            });
            return [subjects.join(","),subjects.length];
        }
        $('.subject').on('change',function(){
            checked_subjects = getSelectedSubjects();
            num_checked = checked_subjects[1];
            checked_subjects = checked_subjects[0];
            $('#amountToPay').text(amounts[num_checked]);
            $('input#subjects').val(checked_subjects);
            $('#num_subjects').val(num_checked);
            if(num_checked > 0) {
                $("#pay-button").prop('disabled',false);
            }
            else {
                $("#pay-button").prop('disabled',true);
            }
        });

    });
</script>
</body>
</html>