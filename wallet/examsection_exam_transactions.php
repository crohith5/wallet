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
    <title>Transactions</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
    <style>
        .container-fluid {
            background-color: ghostwhite;
        }
    </style>
</head>
<body>
<?php
if(!isset($_SESSION['examsection'])) {
    echo "You don't have permission";
    exit();
}

?>
<div class="container-fluid">
    <div class="row">
        <img class="img img-responsive center-block" id="faclogo" src="images/logo.png" alt="">
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="examsection_home.php">Welcome <?php echo $_SESSION['examsection'] ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="examsection_regular.php">Enter Regular Exam Details</a></li>
                    <li><a href="examsection_supply.php">Enter Supply Exam Details</a></li>
                    <li><a href="examsection_delete.php">Delete/View Exams</a></li>
                    <li><a href="examsection_exam_transactions.php">View Paid Exam Details</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="examsection_logout.php">Logout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

<table id="transactions_table" class="table table-bordered table-responsive table-condensed">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Student ID</th>
        <th>Exam ID</th>
        <th>Type</th>
        <th>Subjects</th>
        <th>Amount Paid</th>
        <th>Date & Time</th>
    </tr>
    </thead>
    <thead>
    <tr id="filters">
        <th>Transaction ID</th>
        <th>Student ID</th>
        <th>Exam ID</th>
        <th>Type</th>
        <th>Subjects</th>
        <th>Amount Paid</th>
        <th>Date & Time</th>
    </tr>
    </thead>
    <?php
    include 'include_db_details.php';
    $query = $con->prepare("SELECT `exam_id`,`amount`,`t_id`,`subjects`,`s_id`,`is_regular`,`datetime` FROM exam_transactions ORDER BY `datetime` DESC");
    $query->execute();
    printf("<tbody>");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        printf("<tr>");
        printf("<td>%s</td>", $row['t_id']);
        printf("<td>%s</td>", $row['s_id']);
        printf("<td>%s</td>", $row['exam_id']);
        printf("<td>%s</td>", $row['is_regular'] == '1' ? 'Regular' : 'Supplymentary');
        printf("<td>%s</td>", $row['subjects']);
        printf("<td>%s</td>", $row['amount']);
        printf("<td>%s</td>", $row['datetime']);
        printf("</tr>");
    }
    printf("</tbody>");
    ?>
</table>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>


<script>
    $(document).ready(function () {

        $('#transactions_table tr#filters th').each( function () {
            var title = $('#transactions_table thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
        } );


        $("#transactions_table tr#filters input").on( 'keyup change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        } );


        var table = $('#transactions_table').DataTable( {
            "order":[[6,'desc']],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );


        function stopPropagation(evt) {
            if (evt.stopPropagation !== undefined) {
                evt.stopPropagation();
            } else {
                evt.cancelBubble = true;
            }
        }

    });
</script>
</body>
</html>
