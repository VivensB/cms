<?php

include('../../include/connect.php');
    include('../../include/header.php');
    include('./includes/sidebar.php');
    include('../../base.php');
    include('../../scripts.php');?>

    <div id="content-wrapper">
    <div class="container-fluid">
        <h2>Datas of user(s)</h2>
    
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
                        echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#UpdateEmployee' . $row['user_id'] . '">Edit</a>';
                        if ($row['status'] == "active") {
                            echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#modal_user_update' . $row['user_id'] . '">Diactivate</a>';
                        }elseif ($row['status'] == "inactive") {
                            echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#UpdateEmployee' . $row['user_id'] . '">Activate</a>';
                        
                        }
                       
                    
                    }?>
               </table>

               <div id="modal_user_update" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content" style="width: 130%">
                                <div class="modal-header">
                                    <h3>Modi USER</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">


                                    <form method="POST" action="#">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <input type="text" id="inputName1" class="form-control"
                                                    placeholder="Name" name="name" value="<?php echo $row['name']; ?>"
                                                    autofocus="autofocus" required>
                                                <input type="hidden" id="inputName1" class="form-control" name="id"
                                                    value="<?php echo $row['emp_id']; ?>" autofocus="autofocus"
                                                    required>
                                                <label for="inputName1">Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <input type="number" id="inputAge1" class="form-control"
                                                    placeholder="Age" name="age" value="<?php echo $row['age']; ?>"
                                                    required>
                                                <label for="inputAge1">Age</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <input type="text" id="inputAddress1" class="form-control"
                                                    placeholder="Address" value="<?php echo $row['address']; ?>"
                                                    name="add" required>
                                                <label for="inputAddress1">Address</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <input type="text" id="inputContact1" class="form-control"
                                                    placeholder="Contact Number"
                                                    value="<?php echo $row['contact_number']; ?>" name="contact"
                                                    required>
                                                <label for="inputContact1">Contact Number</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <input type="text" id="position" class="form-control"
                                                    placeholder="Position" value="<?php echo $row['position']; ?>"
                                                    name="position" required>
                                                <label for="position">Position</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                                <span class="glyphicon glyphicon-remove-sign"></span>
                                            </button>
                                            <input type="submit" name="update" value="Update" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <?php
                    include('../../include/footer.php');?>

