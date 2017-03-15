<?php
session_start();
if (!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ExamSection supply Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        tr th:not(:first-child), td {
            max-width: 70px;
        }

        tr input {
            min-width: 10px;
            max-width: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<?php
include 'examsection_header.php';
?>
<form id="supply_form" class="form text-center" method="POST" action="insert_supply_exam_details.php" role="form"
      data-toggle="validator">
    <div class="col-xs-8 col-xs-push-2">
        <div class="form-group">
            <label for="exam_id" class="col-lg-4 text-right">Exam ID:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="exam_id" id="exam_id" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="regulation" class="col-lg-4 text-right">Regulation:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="regulation" id="regulation" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="branch" class="col-lg-4 text-right">Branch:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="branch" id="branch" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="semester" class="col-lg-4 text-right">Semester:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" name="semester" id="semester" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="num_subjects" class="col-lg-4 text-right">Number of subjects:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control" maxlength="1" name="num_subjects" id="num_subjects"
                       onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0'
                       required>
            </div>
        </div>
        <div id="subjects_container">
        </div>
    </div>
    <table class="table table-bordered table-responsive table-condensed">
        <tr id="subject_id_container">
            <th>Number of Subjects</th>
        </tr>
        <tr id="amount_container">
            <th>Amount</th>
        </tr>
    </table>
    <input type="button" data-toggle="modal" data-target="#confirm-submit"  id="submitBtn" class="btn btn-primary" value="Submit"/>
</form>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to submit the following details?
                <table class="table table-bordered">
                    <tbody id="confirm_supply_table"></tbody>
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
    $(document).ready(function () {
        $("#num_subjects").on("change paste", function () {
            $("#subjects_container").html("");
            $("#subject_id_container").html("<th>Number of Subjects</th>");
            $("#amount_container").html("<th>Amount</th>");
            var val = $("#num_subjects").val();
            var i = 1;
            while (i <= val) {
                var html = "<div class='form-group'><label for='subject_" + i + "' class='col-lg-4 text-right'>Subject " + i + ": </label><div class='col-lg-8'><input type='text' pattern='^[^,]*$' class='form-control' name='subject_" + i + "' id='subject_" + i + "' required></div></div>";
                var sub = $($.parseHTML(html));
                $("#subjects_container").append(sub);
                var sub_id = $($.parseHTML("<th>" + i + "</th>"));
                $("#subject_id_container").append(sub_id);
                var sub_amount = $($.parseHTML("<td>" + "<input type='text'  onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' name='amount_subjects_" + i + "' required/></td>"));
                $("#amount_container").append(sub_amount);
                i += 1;
            }
            $("#supply_form").validator('update');
        });
        function getFormValues() {
            var $inputs = $('#supply_form :input');
            console.log($inputs.length);
            var values = {};
            var i = 1;
            $inputs.each(function() {
                if($(this).attr('type') !== 'button') {
                    var name ='';
                    if(this.name.indexOf('amount_subjects')) {
                        name = $('label[for="' + this.name + '"]').text();
                    }
                    else {
                        name = i + " Subject Amount";
                        i += 1;
                    }
                    values[name] = $(this).val();
                }

            });
            return values;
        }
        $('#submitBtn').click(function() {
            var values = getFormValues();
            for(var key in values) {
                if(values.hasOwnProperty(key)) {
                    $('#confirm_supply_table').append($($.parseHTML('<tr><th>'+key+'</th><td>'+values[key]+'</td></tr>')));
                }
            }
        });
        $("#submit").click(function() {
            $("#supply_form").submit();
        });
    });
</script>
</body>
</html>
