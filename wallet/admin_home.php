<?php
session_start();
if(!isset($_SESSION['admin'])) {
    echo "You don't have permission";
    exit();
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin home Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php
 include 'admin_header.php'
?>
</body>
</html>
