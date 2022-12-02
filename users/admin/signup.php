<?php

include('../../include/connect.php');
    include('../../include/header.php');
    include('./includes/sidebar.php');
    include('../../base.php');
    include('../../scripts.php');

    ?>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            <form method="Post">

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="firstName" class="form-control form-control-lg" name="fname" />
                    <label class="form-label" for="firstName">Full Names</label>
                  </div>

                </div>
              

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                  <div class="form-outline datepicker w-100">
                    <input type="email" class="form-control form-control-lg" id="birthdayDate" name="email" />
                    <label for="birthdayDate" class="form-label">Email</label>
                  </div>

                </div><br><br>
                <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="femaleGender"
                      value="Female" checked />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="maleGender"
                      value="Male" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="text" id="emailAddress" class="form-control form-control-lg" name="address" />
                    <label class="form-label" for="emailAddress">Address</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="tel" id="phoneNumber" class="form-control form-control-lg" name="contact" />
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                  </div>

                </div>

                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="text" id="address" class="form-control form-control-lg" name="user" />
                    <label class="form-label" for="phoneNumber">Username</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="password" id="phoneNumber" class="form-control form-control-lg" name="pass" />
                    <label class="form-label" for="phoneNumber">Password</label>
                  </div>

                </div>
              

              <div class="row">
                <div class="col-12">

                  <select class="select form-control-lg" name="position">
                    <option>Choose position</option>
                    <option value="site manager">Site manager</option>
                    <option value="engineer">Engineer</option>
                    
                  </select>
                  

                </div>
              </div>
                     <br><br>
              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Submit" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
        if ($_POST) {
           
            $name = $_POST['fname'];
            $em = $_POST['email'];
            $gen = $_POST['sex'];
            $add = $_POST['address'];
            $contact = $_POST['contact'];
            $user= $_POST['user'];
            $pass = $_POST['pass'];
            $position = $_POST['position'];
        
            date_default_timezone_set("Asia/Manila");
            $date1 = date("Y-m-d H:i:s");
            $remarks = "user $name was Added";
            $query = "INSERT INTO user(name,gender,email,address,tel,username,password,user_type,status)
                VALUES ('" . $name . "','" . $gen . "','" . $em . "','" . $add . "','" . $contact . "','"
                 . $user . "','" . $pass . "','" . $position . "','active')";
            mysqli_query($db, $query) or die(mysqli_error($db));
            mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
       
        ?>
        <script type="text/javascript">
            alert("New user Added Successfully!.");
            window.location = "view_user.php";
        </script>


<?php
        } 
    include('../../include/footer.php');
?>