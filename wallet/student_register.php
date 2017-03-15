<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>student registration</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <img class="img img-responsive center-block" id="faclogo" src="images/logo.png" alt="">
    </div>
    <div class="col-xs-8 col-xs-push-2 text-center">
        <form id="" action="register_student.php" method="POST" role="form" data-toggle="validator">

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Roll No:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="rollno" id="rollno" required></div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Name:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="name" id="name" required></div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Branch</label>
                <div class="col-xs-8">
                    <select name="branch" id="branch" class="form-control   ">
                        <option value="CIV">CIV</option>
                        <option value="CSE">CSE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                        <option value="MEC">MEC</option>
                    </select>
                </div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Regulation:</label>
                <div class="col-xs-8"><input type="text" class="form-control" name="regulation" id="regulation" required></div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Email:</label>
                <div class="col-xs-8"><input type="email" class="form-control" name="email" id="email" required></div>
            </div>

            <div class="form-group"><label for="exam_id" class="col-xs-4 text-right">Password:</label>
                <div class="col-xs-8"><input type="password" class="form-control" name="password" id="passwprd" required></div>
            </div>

            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>
</div>
</body>
</html>