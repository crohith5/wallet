<?php
session_start();
if(!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ExamSection regular Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>

    </style>
</head>
<body>
<?php
include 'examsection_header.php';
?>
    <div class="col-xs-8 col-xs-push-2 text-center">
        <form id="form_reg_exam" action="insert_regular_exam_details.php" method="POST" role="form" data-toggle="validator">
            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Exam ID:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="exam_id" id="exam_id" required></div>
            </div>
            <div class="form-group"><label for="regulation" class="col-xs-4 text-right">Regulation:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="regulation" id="regulation" required></div>
            </div>
            <div class="form-group"><label for="semester" class="col-xs-4 text-right">Semester:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="semester" id="semester" required></div>
            </div>
            <div class="form-group"><label for="total_amount" class="col-xs-4 text-right">Total Amount:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="amount" id="amount" required></div>
            </div>

            <input type="button" name="btn" value="Submit" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-primary" />
        </form>
    </div>
    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirm Submit
                </div>
                <div class="modal-body">
                    Are you sure you want to submit the following details?
                    <table class="table">
                        <tr>
                            <th>Exam ID:</th>
                            <td id="confirm_exam_id"></td>
                        </tr>
                        <tr>
                            <th>Regulation:</th>
                            <td id="confirm_regulation"></td>
                        </tr>
                        <tr>
                            <th>Semester:</th>
                            <td id="confirm_semester"></td>
                        </tr>
                        <tr>
                            <th>Total Amount:</th>
                            <td id="confirm_total_amount"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" id="submit" class="btn btn-success success">Submit</a>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" charset="utf-8"></script>
<script src="js/validator.js"></script>
<script>
    $(document).ready(function(){
        $("#submitBtn").click(function() {
            $("#confirm_exam_id").text($("#exam_id").val());
            $("#confirm_regulation").text($("#regulation").val());
            $("#confirm_semester").text($("#semester").val());
            $("#confirm_total_amount").text($("#amount").val());
        });
        $("#submit").click(function() {
            $("#form_reg_exam").submit();
        });
    });

</script>
</body>
</html>
