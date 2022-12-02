 <?php
  include "include/connect.php";
  $error = null;
  session_start();
  if (isset($_SESSION["name"])) {
    header("Location: index.php");
  } else {
    if (isset($_POST['submitbtn'])) {
      $username = $_POST['user'];
      $pass = $_POST['pass'];
      $query = mysqli_query($db, "SELECT * FROM `user` WHERE username='$username' && password='$pass' and status='active'");
      $res = mysqli_num_rows($query);
      $row = mysqli_fetch_array($query);
      if($res) {
        if ($row["user_type"] == "engineer") {
          # code...
          if (mysqli_num_rows($query) == 1) {
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userpos'] = $row['user_type'];
            // echo 'OK  ';
            header("location: users/engineer/index.php");
          } else {
            echo '<script>alert("User not recognized.");</script>';
            die();
          }
        } else if ($row["user_type"] == "customer") {
          # code...
          if (mysqli_num_rows($query) == 1) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userpos'] = $row['user_type'];
            // echo 'OK  ';
            header("location: users/customer/index.php");
          } else {
            echo '<script>alert("User not recognized.");</script>';
            die();
          }
        } else if ($row["user_type"] == "site manager") {
          # code...
          if (mysqli_num_rows($query) == 1) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['userpos'] = $row['user_type'];
            // echo 'OK  ';
            header("location: users/site-manager/index.php");
          } 
  
          else {
            echo '<script>alert("User not recognized.");</script>';
          }
        }
  
          else if ($row["user_type"] == "admin") {
            # code...
            if (mysqli_num_rows($query) == 1) {
              $_SESSION['name'] = $row['name'];
              $_SESSION['username'] = $row['username'];
              $_SESSION['userpos'] = $row['user_type'];
              // echo 'OK  ';
              header("location: users/admin/admin_index.php");
            } else {
              echo '<script>alert("User not recognized.");</script>';
            }
  
        } 
      } else {
        echo '<script>alert("Incorrect username or password. Or your account is deactivated");</script>';
      }
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
     <title>CMS - Login</title>
     <!-- Bootstrap core CSS-->
     <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <!-- Custom fonts for this template-->
     <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
     <!-- Custom styles for this template-->
     <link rel="stylesheet" href="./assets/css/login-styles.css">
     <script src="./assets/js/sweet-alert.min.js"></script>
   </head>

   <body>
     <nav class="navbar navbar-expand navbar-dark navbar-customized-login fixed-top">
       <!-- <b class="navbar-brand mr-1">CMS</b> -->
       <img src="./assets/images/logo.png" width="180" height="70" alt="">
       <!-- Navbar Search -->
       <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
         <div class="input-group text-white text-bold">
           <?php
           date_default_timezone_set('Africa/Kigali');
             $Today = date("Y-m-d H:i:s");
            
            echo $Today;
            ?>
         </div>
       </form>
     </nav>
     <div id="wrapper">
   </body>

   </html>
   <div class="container my-5 mt-6">
     <div class="screen">
       <div class="screen__content">
         <form method="POST" class="login">
           <div class="login__field">
             <i class="login__icon fas fa-user"></i>
             <input type="text" required name="user" class="login__input" placeholder="User name">
           </div>
           <div class="login__field">
             <i class="login__icon fas fa-lock"></i>
             <input type="password" name="pass" required class="login__input" placeholder="Password">
           </div>
           <button name="submitbtn" class="button login__submit">
             <span class="button__text">Log In Now</span>
             <i class="button__icon fas fa-chevron-right"></i>
           </button>
         </form>
       </div>
       <div class="screen__background">
         <span class="screen__background__shape screen__background__shape4"></span>
         <span class="screen__background__shape screen__background__shape3"></span>
         <span class="screen__background__shape screen__background__shape2"></span>
         <span class="screen__background__shape screen__background__shape1"></span>
       </div>
     </div>
   </div>
   <div class="text-dark-2">
   <?php
    }
    // include "include/footer.php";
    ?>
   </div>
   </body>

   </html>