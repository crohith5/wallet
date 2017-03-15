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
    <title>Pay exam fee</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
    <style>
        select {
            -moz-appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: #222;
            color: white;
            padding: 15px;
            margin: 0px;
            border: none;
        }
        }

        
    </style>
</head>
<body>
<?php
include 'student_header.php';
?>

<?php

include 'include_db_details.php';

function flatten($a) {
    $flattened = [];
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($a));
    foreach($it as $v) {
        $flattened[] = $v;
    }
    return $flattened;
}

$query = $con->prepare("SELECT DISTINCT regulation FROM (SELECT `regulation` FROM `regular_exams` UNION SELECT `regulation` FROM `supply_exams`)  t");
$query->execute();
$regs = $query->fetchAll(PDO::FETCH_NUM);
$regs = flatten($regs);

$query = $con->prepare("SELECT DISTINCT semester FROM (SELECT `semester` FROM `regular_exams` UNION SELECT `semester` FROM `supply_exams`)  t");
$query->execute();
$sems = $query->fetchAll(PDO::FETCH_NUM);
$sems = flatten($sems);

?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <form method="POST" action="pay_for_exam.php" id="exam-form">
            <ul class="nav navbar-nav">
                <li class="dropdown-active">
                    <select name="branch" id="branch">
                        <option value="def">Select Branch</option>
                        <option value="CIV">CIV</option>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                        <option value="MEC">MEC</option>
                    </select>
                </li>
                <li class="dropdown-active">
                    <select name="semester" id="semester">
                        <option value="def">Select Semester</option>
                        <?php
                        foreach($sems as $s) {
                            printf("<option value=\"%s\">%s</option>",$s,$s);
                        }
                        ?>
                    </select>
                </li>
                <li class="dropdown-active">
                        <select name="regulation" id="regulation">
                            <option value="def">Select Regulation</option>
                        <?php
                            foreach($regs as $r) {
                                printf("<option value=\"%s\">%s</option>",$r,$r);
                            }
                        ?>
                        </select>
                </li>
                <li class="dropdown-active">
                    <select name="type" id="type">
                        <option value="def">Select Regular/Supply</option>
                        <option value="reg">Regular</option>
                        <option value="sup">Supplymentary</option>
                    </select>
                </li>
                <li class="dropdown-active">
                    <select name="exam" id="exam">
                        <option value="def">Select Exam</option>
                    </select>
                </li>
                <li>
                    <p class="navbar-btn">
                        <button type="button" id="go-to-pay" class="btn btn-success">Go</button>
                    </p>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            </ul>
            </form>
        </div>
    </div><!-- /.container-fluid -->
</nav>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".dropdown-menu li a").click(function(){
            var ele = $(this).parent().parent().siblings().first().find('span');
            var text = $(this).text();
            ele.text(text);
            ele.val(text);
        });
        function getExams() {
            var isSelected = $('#type').prop('selectedIndex') != 0 && $('#regulation').prop('selectedIndex') != 0 && $('#branch').prop('selectedIndex') != 0 && $('#semester').prop('selectedIndex') != 0;
            if(isSelected) {
                $.ajax({
                    type: "POST",
                    url: "get_filtered_exams.php",
                    data: {
                        'branch' : $('#branch').val(),
                        'semester' : $('#semester').val(),
                        'regulation': $('#regulation').val(),
                        'reg_or_sup': $("#type").val()

                    },
                    success: function(data) {
                        var exams = JSON.parse(data);
                        $('#exam').empty().append($("<option></option>").attr("value","def").text("Select Exam"));
                        for(var i=0;i<exams.length;i++) {
                            $('#exam').append($("<option></option>").attr("value",exams[i]).text(exams[i]));
                        }

                    }
                });
            }
        }
        $('#type').on('change', getExams);
        $('#regulation').on('change', getExams);
        $('#branch').on('change',getExams());
        $('#semester').on('change',getExams());
        $('#go-to-pay').on('click',function(e) {
            var isSelected = ($('#type').prop('selectedIndex') != 0) &&
                             ($('#regulation').prop('selectedIndex') != 0) &&
                             ($('#branch').prop('selectedIndex') != 0 ) &&
                             ($('#semester').prop('selectedIndex') != 0 ) &&
                             ($('#exam').prop('selectedIndex') != 0);
            if(isSelected) {
                $('form#exam-form').submit();
            }
        });
    });
</script>
</body>
</html>
