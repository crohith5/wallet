<?php
session_start();
if(!isset($_SESSION['faculty'])) {
  echo "You don't have permission";
  exit();
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Accountant Login Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
      <?php
      include 'faculty_header.php';
       ?>
      <div class="row" id="faclogin">
        <h2 class="text-center">Accountant Home</h2>
        <div class="col-md-6 col-md-push-3 text-center">
          <form class="form form-inline" method="post">
            <div class="form-group">
              <label for="studentid">Student ID:</label>
              <input type="text" class="form-control" id="studentid"/>
              <button id="getstudentdetails" class="btn btn-inline btn-primary">Submit</button>
            </div>
          </form>
          <br />
          <table class="table table-bordered" id="studentdetailstable">
            <tr>
              <td>ID</td>
              <td id="studentroll"></td>
            </tr>
            <tr>
              <td>Name</td>
              <td id="studentname"></td>
            </tr>
            <tr>
              <td>Branch</td>
              <td id="studentbranch"></td>
            </tr>
            <tr>
              <td>Amount in Wallet</td>
              <td id="studentwalletamount"></td>
            </tr>
          </table>
          <div class="row">
            <div class="col-xs-6">
              <div class="input-group">
                <input id="amountToAdd" type="text" class="form-control" placeholder="Enter Amount" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0'>
                <span class="input-group-btn">
                  <button class="btn btn-default" id="addamount" type="button">add</button>
                </span>
              </div><!-- /input-group -->
            </div>
            <div class="col-xs-6">
              <div class="input-group">
                <input id="amountToDeduct" type="text" class="form-control" placeholder="Enter Amount" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0'>
                <span class="input-group-btn">
                  <button class="btn btn-default" id="deductamount" type="button">Deduct</button>
                </span>
              </div><!-- /input-group -->
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script>
    $(document).ready(function() {
      $("#getstudentdetails").bind("click",function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "getstudentdetails.php",
          data: {'id':$("#studentid").val().toUpperCase()},
          success: function(data) {
            data = JSON.parse(data);
            if(!data) {
              data = {
                "name":"",
                "branch":"",
                "amount":"",
                "rollno":""
              }
              alert("Student details not found");
            }
            $("#studentname").text(data.name);
            $("#studentbranch").text(data.branch);
            $("#studentwalletamount").text(data.amount);
            $("#studentroll").text(data.rollno);
          }
        });
      });
      $("#addamount").bind("click",function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "addamount.php",
          data: {
            'id':$("#studentroll").text().toUpperCase(),
            'amount':$("#amountToAdd").val()
        },
          success: function(data) {
            console.log(data);
            data = JSON.parse(data);
            $("#studentname").text(data.name);
            $("#studentbranch").text(data.branch);
            $("#studentwalletamount").text(data.amount);
            $("#studentroll").text(data.rollno);
          }
        });
      });
      $("#deductamount").bind("click",function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "deductamount.php",
          data: {
            'id':$("#studentroll").text().toUpperCase(),
            'amount':$("#amountToDeduct").val()
        },
          success: function(data) {
            console.log(data);
            data = JSON.parse(data);
            $("#studentname").text(data.name);
            $("#studentbranch").text(data.branch);
            $("#studentwalletamount").text(data.amount);
            $("#studentroll").text(data.rollno);
          }
        });
      });
    });
  </script>
  </body>
</html>
