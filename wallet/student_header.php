<?php
if(!isset($_SESSION['student_id'])) {
    echo "You don't have permission";
    exit();
}

?>
<div class="container">
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
                <a class="glyphicon glyphicon-home navbar-brand" href="wallet_home.html"></a>
                <a class="navbar-brand" href="student_home.php">Welcome <?php echo $_SESSION['student_name'] ?></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="student_transactions.php">My Transactions</a></li>
                    <li><a href="student_pay_exam.php">Pay Exam Fee</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="student_logout.php">Logout</a></li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</div>
