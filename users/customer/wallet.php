<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
include('../../libs.php');
?>
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">
    <div class="container-fluid">
        <h4>Account Wallet<a href="#" data-toggle="modal" data-target="#loadBalance"
                class="btn btn-sm ml-4 btn-primary">Load Balance</a></h4>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-toolbox"></i>
                            </div>
                            <div class="mr-5">Wallet Balance</div>
                            <?php
                            $query1 = "SELECT * from wallet";
                            $result1 = mysqli_query($db, $query1);
                            $row1 = mysqli_fetch_array($result1);
                            echo "" . number_format($row1[1], 2, '.', '') . " " . $row1[3] . "";
                            ?>
                        </div>
                        <a class="card-footer text-white clearfix small z-1"></a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-truck"></i>
                            </div>
                            <div class="mr-5">Total Transactions</div>
                            <?php
                            $query = "SELECT * from transactions";
                            $result = mysqli_query($db, $query);
                            $row = mysqli_num_rows($result);
                            echo "(" . $row . ")";
                            ?>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="transactions.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 my-3">
                    <h6 class="text-13">Latest 10 Transactions</h6>
                </div>
            </div>
            <div class="table-responsive">
                <table id="walletTransactions" class="table table-bordered" style="font-size: 14px !important;"
                    width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Commission</th>
                            <th>Currency</th>
                            <th>Payment method</th>
                            <th>Transaction Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM transactions order by added_at DESC LIMIT 10";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td class="text-bold">' . $row['transactionId'] . '</td>';
                            echo '<td>' . $row['amount'] . '</td>';
                            echo '<td>' . $row['commission'] . '</td>';
                            echo '<td>' . $row['currency'] . '</td>';
                            echo '<td>' . $row['payment_method'] . '</td>';
                            echo '<td>' . $row['transaction_type'] . '</td>';
                            if ($row['status'] == 'paid') {
                                echo '<td>' . '<span class="badge badge-pill badge-success">Paid</span>' . '</td>';
                            } else {
                                echo '<td>' . '<span class="badge badge-pill badge-danger">Unpaid</span>' . '</td>';
                            }
                            echo '<td>' . date("d/m/Y h:i:s", strtotime($row['added_at'])) . '</td>';
                        }
                        ?>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <div id="loadBalance" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                    <div class="modal-header">
                        <h6>Load Account Balance</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <input type="number" id="loadAmount" class="form-control" placeholder="Amount in (RWF)"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="number" id="phoneNumber" class="form-control" placeholder="Phone Number"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <small>
                                    Current Wallet Balance:
                                    <?php
                                    $query1 = "SELECT * from wallet";
                                    $result1 = mysqli_query($db, $query1);
                                    $row1 = mysqli_fetch_array($result1);
                                    echo "" . number_format($row1[1], 2, '.', '') . " " . $row1[3] . "";
                                    ?>
                                </small>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                    <span class="fas fa-times"></span>
                                </button>
                                <input type="submit" id="submitLoad" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../assets/js/axios/axios.min.js"></script>
        <script type="module" src="main.js"></script>
        <?php
        include('../../scripts.php');
        include('../../include/footer.php');
        ?>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $(' #walletTransactions').DataTable({
                    language: {
                        paginate: {
                            previous: '<i class="bx bx-chevron-left"></i>'
                            , next: '<i class="bx bx-chevron-right"></i>',
                        },
                        searchPlaceholder: "Search a transaction ...",
                        emptyTable: "No transactions available.",
                    },
                });
            }); </script>