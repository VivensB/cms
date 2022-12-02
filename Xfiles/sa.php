<?php 
      include('include/header.php');
	  include('user/include/sidebar2.php');?>
<div class="container-fluid ">
    <div class="col-lg-12">

        <br />
        <br />
        <div class="card">
            <div class="card-header">
                <span><b>Attendance List</b></span>
                <button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" data-toggle="modal"
                    data-target="#new_attendance_btn"><span class="fa fa-plus"></span> Add Attendance</button>

                <a href="#" data-toggle="modal" data-target="#new_attendance_btn" class="btn btn-sm btn-info">Add
                    New</a></h2>
            </div>
        </div>
    </div>
</div>






<!-- attendance modal -->


<div id="new_attendance_btn" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h3>Add New Employee</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


                <form method="POST" action="#">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputName" class="form-control" placeholder="Name" name="name"
                                autofocus="autofocus" required>
                            <label for="inputName">Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="number" id="inputAge" class="form-control" placeholder="Age" name="age"
                                required>
                            <label for="inputAge">Age</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputAddress" class="form-control" placeholder="Address" name="add"
                                required>
                            <label for="inputAddress">Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputContact" class="form-control" placeholder="Contact Number"
                                name="contact" required>
                            <label for="inputContact">Contact Number</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="position1" class="form-control" placeholder="Position"
                                name="position" required>
                            <label for="position1">Position</label>
                        </div>
                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                            <span class="glyphicon glyphicon-remove-sign"></span>
                        </button>
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php

include('include/scripts.php');
include('include/footer.php');
?>