<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
?>
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">
    <div class="container-fluid">
        <h4>List of Employee(s)</h4>
        <form method="POST" class="form-inline my-4">
            <div class="form-group mb-2">
                <label class="sr-only"></label>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Choose attendance date">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="date" name="attendanceDate" class="form-control" id="attendance-date" placeholder="Attendance date">
            </div>
            <button type="submit"  name="submitAttendanceDate" class="btn btn-primary btn-sm mb-2">Submit</button>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size:14px;" class="table table-bordered" id="employeePayouts" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Emp Ref</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Position</th>
                            <th>Phone Contact</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT * FROM employees";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['empl_ref'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['position'] . '</td>';
                        echo '<td>' . $row['contact_number'] . '</td>';
                    ?>
                    <?php
                        echo '</tr> ';
                    }
                        ?>
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
                                <input type="submit" name="submit" value="Save" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['submitAttendanceDate'])) {
           $attendanceDate = $_POST["attendanceDate"];
        //    $select = "SELECT * FROM attendance WHERE logdate='$attendanceDate'";
        //    $query = mysqli_query($db,$select);
           echo '<script>window.location.href="payout-resuts.php?datetime='.$attendanceDate.'"</script>';
        ?>
        <?php
        }
        include('../../scripts.php');
        include('../../include/footer.php');
        ?>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $(' #employeePayouts').DataTable({
                    language: {
                        paginate: {
                            previous: '<i class="bx bx-chevron-left-circle"></i>'
                            , next: '<i class="bx bx-chevron-right-circle"></i>',
                        },
                        searchPlaceholder: "Search an employee ...",
                        emptyTable: "No employee available.",
                    },
                });
            }); </script>