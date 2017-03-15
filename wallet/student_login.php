<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Login Page</title>
    <link rel="stylesheet" href="css/style.css  ">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/loginform.css">
</head>
<body>
<div class="container">
    <div class="row">
        <a href="wallet_home.html"> <img class="img img-responsive center-block" id="faclogo" src="images/logo.png" alt=""></a>
    </div>
    <div align="right" id="faclogin">
        <form action="student_register.php" method="get">
        <input type="submit" value="new register">
        </form>
    </div>
    <div class="row" id="faclogin">
        <div class="col-md-6 col-md-push-3">
            <form class="form" action="studentlogin_check.php" method="POST">
                <div class="form-group">
                    <label for="rollno">Rollno:</label>
                    <input type="text" id="rollno" name="rollno" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" class="form-control" name="password">
                    <br>
                    <input class="btn center-block" type="submit" value="login"></button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>