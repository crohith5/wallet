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
    <title>accountant registration</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php
include "admin_header.php"
?>
<div class="container">
    <div class="col-xs-8 col-xs-push-2 text-center">
        <form id="" action="register_faculty.php" method="POST" role="form" data-toggle="validator">

            <div class="form-group"><label class="col-xs-4 text-right">ID:</label>
                <div class="col-xs-8"><input type="number" class="form-control" maxlength="1" name="id" id="id" required></div>
            </div>

            <div class="form-group"><label class="col-xs-4 text-right">name:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="username" id="username" required></div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">password:</label>
                <div class="col-xs-8"><input type="password" class="form-control" name="password" id="password" required></div>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>
</div>
</body>
</html>
