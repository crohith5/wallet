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
    <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
</head>
<body>
<?php
include 'student_header.php';
?>
<table id="transactions_table" class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>Transaction ID</th>
        <th>Faculty ID</th>
        <th>Description</th>
        <th>Date & Time</th>
    </tr>
    </thead>
    <thead>
    <tr id="filters">
        <th>Transaction ID</th>
        <th>Faculty ID</th>
        <th>Description</th>
        <th>Date & Time</th>
    </tr>
    </thead>
    <?php
    include 'include_db_details.php';
    $query = $con->prepare("SELECT `t_id`,`f_id`,`s_id`,`reason`,`datetime`,`is_debited`FROM transactions  WHERE `s_id`=:s_id  ORDER BY `datetime` DESC");
    $query->bindParam(':s_id',$_SESSION['student_id'],PDO::PARAM_STR);
    $query->execute();
    printf("<tbody>");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row['is_debited'] == '0') {
            printf("<tr class='transaction_credit'>");
        } else {
            printf("<tr class='transaction_debit'>");
        }
        printf("<td>%s</td>", $row['t_id']);
        printf("<td>%s</td>", $row['f_id']);
        printf("<td>%s</td>", $row['reason']);
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
            "order":[[3,'desc']],
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
