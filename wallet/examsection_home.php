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
    <title>ExamSection home Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
      tr th:not(:first-child),td {
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
     <h4>Use navbar to enter exam details</h4>
     <?php
        if(array_key_exists('infomsg',$_GET)) {
            printf("<div class='alert alert-success'>
                %s
            </div>",$_GET['infomsg']);
        }
         if(array_key_exists('errormsg',$_GET)) {
             printf("<div class='alert alert-danger'>
                    %s
                </div>",$_GET['errormsg']);
         }
     ?>
    <!-- Put some content here -->
    <script src="js/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
          $(".alert").delay(2000).slideUp(200, function() {
              $(this).alert('close');
          });
      });
  </script>
  </body>
</html>
