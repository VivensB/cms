<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
?>
<div id="content-wrapper">
    <div class="container">
        <h4 class="text-14">
            <?php
            if (isset($_GET['datetime']) && isset($_GET['emp_id']) && isset($_GET["name"])) {
                echo '<h6>' . date("d/m/Y", strtotime($_GET['datetime'])) . '<span style="font-size:16px;" class="text-capitalize text-bold"> ' . $_GET['name'] . ' with employee code ' . $_GET['emp_id'] . ' </span></h6>';
            } else {
                // Fallback behaviour goes here
            }
            ?> Attendance checkout
        </h4>
        <div class="card-body">
            <?php
            $query = mysqli_query($db, "SELECT * FROM attendance WHERE emp_id='" . $_GET['emp_id'] . "'");
            $getEmpData = mysqli_query($db,"SELECT * FROM employees WHERE empl_ref='".$_GET['emp_id']."'");
            $rows = mysqli_fetch_array($getEmpData);
            $queryWallet = "SELECT * from wallet";
            $result12 = mysqli_query($db, $queryWallet);
            $row12 = mysqli_fetch_array($result12);
            $res = mysqli_num_rows($query);
            $resAttend = mysqli_fetch_array($query);
            if (($resAttend["scan_num"] == 4) && ($resAttend["status"] == 1)) { ?>
            <div class="row">
                <div class="col">
                    <div class="jumbotron">
                        <h1 class="display-6 text-19">Employee payouts</h1>
                        <hr>
                        <p class="lead text-15">Available Balance:
                            <?php
                                $query1 = "SELECT * from wallet";
                                $result1 = mysqli_query($db, $query1);
                                $row1 = mysqli_fetch_array($result1);
                                echo "" . number_format($row1[1], 2, '.', '') . " " . $row1[3] . "";
                            ?>
                        </p>
                        <hr class="my-4">
                        <p>
                        <form method="post">
                            <div class="form-group">
                                <label for="phoneNumberToPay">Employee Name</label>
                                <input type="hidden" id="empRef" value="<?php echo $_GET['emp_id']; ?>" name="">
                                <input type="hidden" name="" id="walletBalance" value="<?php echo $row12['wallet_balance']; ?>">
                                <input id="empName" required placeholder="Employee Name" class="form-control"
                                    type="text" value="<?php echo $_GET['name']; ?>" disabled readonly name="">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumberToPay">Phone Number</label>
                                <input id="phoneNumberToPay" value="<?php echo $rows['contact_number'] ?>" required placeholder="Phone Number" class="form-control"
                                    type="number" name="">
                            </div>
                            <div class="form-group">
                                <label for="AmountToPay">Payment Value - (RWF)</label>
                                <input id="AmountToPay" required placeholder="Amount" class="form-control" type="text"
                                    name="amount">
                            </div>
                            <button type="submit" id="submitTopay" class="btn btn-sm btn-primary"> <i class="fas fa-money-bill"></i>
                                Process Payment</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="row">
                <div class="col-8">
                    <div class="alert text-14 alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Sorry!</strong> This employee has insufficient attendance and payouts can't be
                        processed.
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <script src="../../assets/js/axios/axios.min.js"></script>
        <script type="module" src="processPayment.js"></script>
        <?php
            include('../../scripts.php');
            include('../../include/footer.php');
        ?>