<?php
session_start();
if (!$_SESSION["name"]) {
  header("Location: login.php");
  date_default_timezone_set('Africa/Kigali');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../include/../../assets/images/favicon.png" type="image/x-icon">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Construction Monitoring System</title>
</head>
<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark navbar-customized-accounts bg-dark static-top">
    <!-- <b class="navbar-brand mr-1">CMS</b> -->
    <img class="logo-custom" src="../include/../../assets/images/logo.png" width="180" height="70" alt="">
    <!-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button> -->
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group text-bold" style="color: #002e5d">
        <?php
        $Today = date("r");
       
        echo $Today;
        ?>
      </div>
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
    
        <a class="nav-link dropdown-toggle text-bold" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
          if (!isset($_SESSION['name'])) {
            # code...
            echo "";
          } else {
            echo "" . $_SESSION['userpos']."||";
            echo "" . $_SESSION['name'];}
          
          ?>
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#"><i class="fas fa-user-circle fa-fw"></i>
            <?php
            if (!isset($_SESSION['name'])) {
              # code...
              echo "";
            } else {
              echo "" . $_SESSION['name'];
            }
            ?></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class='bx bx-log-out-circle'></i>  Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
</body>

</html>