<?php

include('../../include/connect.php');
    include('../../include/header.php');
    include('./includes/sidebar.php');
    include('../../base.php');
    include('../../scripts.php');?>
                    <?php
if ($_POST) {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'deactivate':
                if (isset($_POST['user_id'])) {
                    $query = "UPDATE user SET status='inactive' WHERE user_id =".$_POST['user_id'];
                    if (mysqli_query($db,$query)) {
                        echo "<script>alert('user de-activated successfully')</script>";
                    }
                }
                break;
            case 'activate':
                if (isset($_POST['user_id'])) {
                    $query = "UPDATE user SET status='active' WHERE user_id =".$_POST['user_id'];
                    if (mysqli_query($db,$query)) {
                        echo "<script>alert('user activated successfully')</script>";
                    }
                }
                break;
            default:
                // code...
                break;
        }
    }
}
?>





<div id="modal_user_deactivate" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="width: 130%">
                                <div class="modal-header">
                                    <h3>Deactivate USER</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body deactivate">


                                    <form method="POST" action="#">
                                        <input type="hidden" name="action" value="deactivate">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <b id="user__name" class="form-control"></b>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                                <span class="glyphicon glyphicon-remove-sign"></span>
                                            </button>
                                            <input type="submit" name="deactivate" value="De Activate" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal_user_activate" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="width: 130%">
                                <div class="modal-header">
                                    <h3>Activate USER</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body activate">


                                    <form method="POST" action="#">
                                        <input type="hidden" name="action" value="activate">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <b id="user__name" class="form-control"></b>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                                <span class="glyphicon glyphicon-remove-sign"></span>
                                            </button>
                                            <input type="submit" name="deactivate" value="Activate" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>





               

            






    <div id="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <h2>Datas of user(s)</h2>
            </div>
            <div class="col">
                    <h2><a href="#" class="btn btn-sm btn-info" href="#" data-toggle="modal" data-target="#modal_add_c">Add User</a></h2>
                </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>username</th>
                            <th>Password</th>
                            <th>position</th>
                            <th>status</th>
                            <th colspan="3">Options</th>
                        </tr>
                    </thead>

                    <?php

                    $query = "SELECT * FROM user";
                  
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['status']== 0){


                        }

                        echo '<tr>';
                        
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['gender'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['tel'] . '</td>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>' . $row['password'] . '</td>';
                        echo '<td>' . $row['user_type'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        
                        if ($row['status'] == "active") {
                            echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#modal_user_deactivate" onclick="$(\'.deactivate #user_id\').val(\'' .$row['user_id'] .'\');$(\'.deactivate #user__name\').html(\'' . $row['name'] . '\')">Diactivate</a>';
                        }elseif ($row['status'] == "inactive") {
                            echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#modal_user_activate" onclick="$(\'.activate #user_id\').val(\'' .$row['user_id'] .'\');$(\'.activate #user__name\').html(\'' . $row['name'] . '\')">Activate</a>';
                        
                        }
                       
                    
                    }?>
               </table>
                
               



         
 <div id="modal_add_c" class="modal fade" role="dialog"  style="z-index: 99999;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h3>Registration Form</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body activate">
              <form method="Post">

                <div class="row">
                  <div class="col-md-12 mb-4">

                    <div class="form-outline">
                      <input type="text" id="firstName" class="form-control form-control-lg" name="fname" required />
                      <label class="form-label" for="firstName">Full Names</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <input type="email" class="form-control form-control-lg" id="birthdayDate" name="email" required />
                      <label for="birthdayDate" class="form-label">Email</label>
                    </div>

                  </div>
                  
                  <br><br>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sex" id="femaleGender"
                        value="Female" checked required />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sex" id="maleGender"
                        value="Male" required />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="text" id="emailAddress" class="form-control form-control-lg" name="address" required />
                      <label class="form-label" for="emailAddress">Address</label>
                    </div>

                  </div>

                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="tel" id="phoneNumber" class="form-control form-control-lg" name="contact" required />
                      <label class="form-label" for="phoneNumber">Phone Number</label>
                    </div>

                  </div>

                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="text" id="address" class="form-control form-control-lg" name="user" required />
                      <label class="form-label" for="phoneNumber">Username</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="password" id="phoneNumber" class="form-control form-control-lg" name="pass"required />
                      <label class="form-label" for="phoneNumber">Password</label>
                    </div>

                  </div>
                

                <div class="row">
                  <div class="col-12">

                    <select class="select form-control" name="position" required>
                      <option>Choose position</option>
                      <option value="site manager">Site manager</option>
                      <option value="engineer">Engineer</option>
                      <option value="customer">Customer</option>
                      <option value="admin">Admin</option>
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
                VALUES ('" . $name . "','" . $gen . "','" . $em . "','" . $add . "','" . $contact . "','" . $user . "','" . $pass . "','" . $position . "','active')";
            mysqli_query($db, $query) or die("<span  class='error'>" . mysqli_error($db) . "</span>");
            mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
 
   ?>

        <script type="text/javascript">
          alert("Item Added Successfully!.");
          window.location = "Item.php";
        </script>
<?php }
include('../../include/footer.php');?>

              
