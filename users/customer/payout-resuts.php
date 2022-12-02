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
        <h4 class="text-16">
            <?php
            if (isset($_GET['datetime'])) {
                echo date("d/m/Y", strtotime($_GET['datetime']));
            } else {
                // Fallback behaviour goes here
            }
            ?> Attendance Results
        </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size:13px !important;" id="employeeAttendance" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Attendance ID</th>
                            <th>LogIn Date</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Time In (Am)</th>
                            <th>Time Out (Am)</th>
                            <th>Time In (Pm)</th>
                            <th>Time Out (Pm)</th>
                            <th>Att. Scan Number</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT * FROM attendance WHERE logdate='" . $_GET['datetime'] . "'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['att_id'] . '</td>';
                        echo '<td>' . $row['logdate'] . '</td>';
                        echo '<td>' . $row['emp_id'] . '</td>';
                        echo '<td><span class="text-capitalize">' . $row['name'] . '</span></td>';
                        echo '<td>' . $row['Timein'] . '</td>';
                        echo '<td>' . $row['Timeout'] . '</td>';
                        echo '<td>' . $row['Timein_PM'] . '</td>';
                        echo '<td>' . $row['Timeout_PM'] . '</td>';
                        echo '<td>' . $row['scan_num'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        if($row["scan_num"] == 4 && $row["status"] ==1){
                            echo '
                            <td>
                                <a href="attendance-checkout.php?emp_id=' . $row['emp_id'] . '&datetime=' . $row['logdate'] . '&name=' . $row['name'] . '" class="btn btn-sm btn-info"> 
                                    <i class="fas fa-check-double"></i> Checkout
                                </a> 
                            </td>';
                        }else{
                            echo '
                            <td>
                                <button title="Payouts not available to this employee according to uncompleted attendances today." class="btn btn-sm btn-danger" disabled> 
                                    <i class="fa-solid fa-triangle-exclamation"></i> Checkout
                                </button> 
                            </td>';
                        }
                    ?>
                    <?php
                        echo '</tr> ';
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php
        if (isset($_POST['submitAttendanceDate'])) {
            $attendanceDate = $_POST["attendanceDate"];
            //    $select = "SELECT * FROM attendance WHERE logdate='$attendanceDate'";
            //    $query = mysqli_query($db,$select);
            echo '<script>window.location.href="/payout-resuts.php?datetime=' . $attendanceDate . '"</script>';
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
                $(' #employeeAttendance').DataTable({
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