<?php
if(!isset($_SESSION['faculty'])) {
  echo "You don't have permission";
  exit();
}

 ?>
<div class="container">
  <div class="row">
      <a href="wallet_home.html">
    <img class="img img-responsive center-block" id="faclogo" src="images/logo.png" alt="">
      </a>
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
  <a class="navbar-brand" href="facultyhome.php">Welcome <?php echo $_SESSION['faculty'] ?></a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">

  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li><a href="faculty_viewtransactions.php">View Transactions</a></li>
    <li><a href="facultylogout.php">Logout</a></li>
  </ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
