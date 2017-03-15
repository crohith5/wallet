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
    <title>Delete exam notifications</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        h3 {
            padding: 5px;
        }
        .deleteColumn {
            width: 100px;
        }
        tr button {
            width: 100%;
        }
    </style>
</head>
<body>
<?php
include 'examsection_header.php';
?>
<h3 class="text-center bg-primary">Regular Exams</h3>
<table class="table table-bordered table-condensed table-responsive">
    <thead>
    <th>Name</th>
    <th>Regulation</th>
    <th>Semester</th>
    <th class="deleteColumn">Delete</th>
    </thead>
    <tbody>
    <?php
    include 'include_db_details.php';

    $query = $con->prepare("SELECT * FROM regular_exams");
    if($query->execute()) {
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $row) {
            printf("<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>",$row['name'],$row['regulation'],$row['semester']);
            printf("<td><button id='%s' class='btn btn-danger regular'>Delete</button></td>",$row['name']);
            printf("</tr>");
        }
    }

    ?>
    </tbody>
</table>

<h3 class="text-center bg-primary">Supplementary Exams</h3>
<table class="table table-bordered table-condensed table-responsive">
    <thead>
        <th>Name</th>
        <th>Regulation</th>
        <th>Branch</th>
        <th>Semester</th>
        <th class="deleteColumn">Delete</th>
    </thead>
<tbody>
<?php
include 'include_db_details.php';

$query = $con->prepare("SELECT * FROM supply_exams");
if($query->execute()) {
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row) {
        printf("<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>",$row['name'],$row['regulation'],$row['branch'],$row['semester']);
        printf("<td><button  id='%s' class='btn btn-danger supply'>Delete</button></td>",$row['name']);
        printf("</tr>");
    }
}

?>
</tbody>
</table>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        $('button.supply').click(function() {
            var exam_name = this.id;
            var del = confirm("Really delete the exam - " + exam_name + "?");
            var tr = $(this).parent().parent();
            if(del === true) {
                $.ajax({
                    type: "POST",
                    url: "delete_supply_exam.php",
                    data: {
                        'name': exam_name
                    },
                    success: function(data) {
                        tr.remove();
                        alert(data);
                    }
                });
            }
        });
        $('button.regular').click(function() {
            var exam_name = this.id;
            var del = confirm("Really delete the exam - " + exam_name + "?");
            var tr = $(this).parent().parent();
            if(del === true) {
                $.ajax({
                    type: "POST",
                    url: "delete_regular_exam.php",
                    data: {
                        'name': exam_name
                    },
                    success: function(data) {
                        tr.remove();
                        alert(data);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
