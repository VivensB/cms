<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
?>
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<div id="content-wrapper">
    <div class="container-fluid">
        <h2>List of Employee(s)<a href="#" data-toggle="modal" data-target="#AddEmployee"
                class="btn btn-sm ml-4 btn-primary">Add New</a></h2>
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 13px;" id="employeeTable" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Emp Ref</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM employees";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['empl_ref'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['age'] . '</td>';
                            echo '<td>' . $row['address'] . '</td>';
                            echo '<td>' . $row['contact_number'] . '</td>';
                            echo '<td>' . $row['position'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                        ?>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a style="font-size: 13px;" type="button"
                                    class="btn btn-sm btn-warning mr-2 fa fa-edit fw-fa" href="#" data-toggle="modal"
                                    data-target="#UpdateEmployee<?php echo $row['emp_id'];?>">Edit</a>
                                <a style="font-size: 13px;" type="link" onclick="return confirm('Are you sure to delete this employee ?')" class="btn btn-sm btn-danger mr-2 bx bx-x"
                                    href="delete-employee.php?emp_id=<?php echo $row['emp_id']; ?>">Delete</a>         
                            
                       <?php ?>
                        <div id="UpdateEmployee<?php echo $row['emp_id']; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content" style="width: 130%">
                                    <div class="modal-header">
                                        <h3>Modify Employee</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">


                                        <form method="POST" action="#">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <input type="text" id="inputName1" class="form-control"
                                                        placeholder="Name" name="name"
                                                        value="<?php echo $row['name']; ?>" autofocus="autofocus"
                                                        required>
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
                                                <input type="submit" name="update" value="Update"
                                                    class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if (isset($_POST['update'])) {
                                $id = $_POST['id'];
                                $name = $_POST['name'];
                                $age = $_POST['age'];
                                $add = $_POST['add'];
                                $contact = $_POST['contact'];
                                $position = $_POST['position'];
                                date_default_timezone_set("Asia/Manila");
                                $date1 = date("Y-m-d H:i:s");
                                $remarks = "employee $name was updated";
                                $query = "UPDATE `employees` SET `name`='$name',`age`='$age',`address`='$add',`contact_number`='$contact',`position`='$position' WHERE `emp_id`='$id'";
                                mysqli_query($db, $query) or die(mysqli_error($db));
                                mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
                        ?>
                        <script type="text/javascript">
                            alert("Employee Updated Successfully!.");
                            window.location = "employees.php";
                        </script>
                        <?php
                            }
                            echo '</td> ';
                            echo '</tr> ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="AddEmployee" class="modal fade" role="dialog">
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
                                    <input type="text" id="inputName" class="form-control" placeholder="Name"
                                        name="name" autofocus="autofocus" required>
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
                                    <input type="text" id="inputAddress" class="form-control" placeholder="Address"
                                        name="add" required>
                                    <label for="inputAddress">Address</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="text" id="inputContact" class="form-control"
                                        placeholder="Contact Number" name="contact" required>
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
                                <input type="submit" name="submitEmployee" value="Save" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['submitEmployee'])) {
            $date = date("Y");
            $name = $_POST['name'];
            $age = $_POST['age'];
            $add = $_POST['add'];
            $contact = $_POST['contact'];
            $position = $_POST['position'];
            $ref = rand(100000, 999999);
            date_default_timezone_set("Asia/Manila");
            $date1 = date("Y-m-d H:i:s");
            $remarks = "employee $name was Added";
            $query = "INSERT INTO employees(empl_ref,name,age,address,contact_number,position,status)
                VALUES ('$ref','$name','$age','$add','$contact','$position','active')";
            mysqli_query($db, $query) or die(mysqli_error($db));
            mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
        ?>
        <script type="text/javascript">
            alert("New Employee Added Successfully!.");
            window.location = "employee.php";
        </script>
        <?php
        }
        include('../../scripts.php');
        include('../../include/footer.php');
        ?>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $(' #employeeTable').DataTable({
                    language: {
                        paginate: {
                            previous: '<i class="bx bx-chevron-left"></i>'
                            , next: '<i class="bx bx-chevron-right"></i>',
                        },
                        searchPlaceholder: "Search an employee ...", emptyTable: "No employee available.",
                    },
                });
            }); </script>