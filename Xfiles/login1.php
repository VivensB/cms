 
 <?php
session_start();
// define variables and set to empty values
$Message = $Erroremail = $Errorpass = "";
 if(isset($_POST['user'])){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $usertype = check_input($_POST["status"]);
  

    $email = check_input($_POST["user"]);
  
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$email)) {
      $Erroremail = ""; 
    }
  else{
    $femail=$email;
  }
 
  $fpass = check_input($_POST["pass"]);

  if ($Erroremail!=""){
  $Message = "Login failed! Errors found";

  }
  else{
  include "include/connect.php";
  
  $query=mysqli_query($db,"select * from `user` where username='$email' && password='$fpass'");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
  
  
  if ($num_rows>0){
    $Message = "Login Successful!";
  }
  else{
  $Message = "Login Failed! User not found";
  $_SESSION['message']=$Message;
  unset($_SESSION['name']);
  session_destroy();
  include "login.php";
  }
  
  }
}
}

function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<center>
<?php

 //  =========================Login of Client=========================

  if ($row1['user_type'] =='customer'){
    $_SESSION["name"]=$row1['name'];
  $name = $row1['name'];
  date_default_timezone_set("Asia/Manila"); 
  $date1 = date("Y-m-d H:i:s");

  $remarks="user $name was login"; 
  mysqli_query($db,"INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')")or die(mysqli_error($db));
   // echo $Message;
   // include "index.php";
    //include "footer.php";
    ?>
<script type="text/javascript">
      alert("Login Successfull.");
      window.location = "index.php";
    </script>

    <?php
  }
  

   //  =========================Login of Engineer=========================
 if($row['user_type']=='engineer'){
    $_SESSION["name"]=$row['name'];
  $name = $row['name'];
  date_default_timezone_set("Asia/Manila"); 
  $date1 = date("Y-m-d H:i:s");

  $remarks="user $name was login"; 
  mysqli_query($db,"INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')")or die(mysqli_error($db));
   // echo $Message;
   // include "index.php";
    //include "footer.php";
    ?>
<script type="text/javascript">
      alert("Login Successfull.");
      window.location = "engineer_index.php";
    </script>

    <?php
  }
 
   //  =========================Login of site Manager=========================

 if ($row['user_type']=='site manager'){
    $_SESSION["name"]=$row['name'];
  $name = $row['name'];
  date_default_timezone_set("Asia/Manila"); 
  $date1 = date("Y-m-d H:i:s");

  $remarks="user $name was login"; 
  mysqli_query($db,"INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')")or die(mysqli_error($db));
   // echo $Message;
   // include "index.php";
    //include "footer.php";
    ?>
<script type="text/javascript">
      alert("Login Successfull.");
      window.location = "site_manager_index.php";
    </script>

    <?php
  }
  
  else{
    echo $Message;

  }

  if ($row['user_type']=='admin'){
    $_SESSION["name"]=$row['name'];
  $name = $row['name'];
  date_default_timezone_set("Asia/Manila"); 
  $date1 = date("Y-m-d H:i:s");

  $remarks="user $name was login"; 
  mysqli_query($db,"INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')")or die(mysqli_error($db));
   // echo $Message;
   // include "index.php";
    //include "footer.php";
    ?>
<script type="text/javascript">
      alert("Login Successfull.");
      window.location = "admin_index.php";
    </script>

    <?php
  }
  
  else{
    echo $Message;

  }

?>