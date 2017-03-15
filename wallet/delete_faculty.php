<?php
session_start();
if(!isset($_SESSION['admin'])) {
    echo "You don't have permission";
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delete accountent</title>
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
include 'admin_header.php';
?>
<table class="table table-bordered table-condensed table-responsive">
    <thead>
    <th>ID</th>
    <th>username</th>
    <th class="deleteColumn">Delete</th>
    </thead>
    <tbody>
    <?php
    include 'include_db_details.php';

    $query = $con->prepare("SELECT * FROM faculty");
    if($query->execute()) {
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $row) {
            printf("<tr>
                    <td>%s</td>
                    <td>%s</td>",$row['id'],$row['username'],$row['password']);
            printf("<td><button id='%s' class='btn btn-danger regular'>Delete</button></td>",$row['id']);
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
        $('button.regular').click(function() {
            var exam_name = this.id;
            var del = confirm("Really delete the accountant - " + exam_name + "?");
            var tr = $(this).parent().parent();
            if(del === true) {
                $.ajax({
                    type: "POST",
                    url: "delete_faculty_data.php",
                    data: {
                        'id': exam_name
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
