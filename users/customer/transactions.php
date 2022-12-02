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
        <h5>Transaction(s) </h5>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size:14px;" class="table table-bordered" id="allTransactions" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction Batch</th>
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
                        $query = "SELECT * FROM transactions order by added_at DESC";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td><span class="text-bold text-success">' . $row['transactionId'] . '</span></td>';
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
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#table').DataTable();
            });
        </script>
        <?php

        include('../../scripts.php');
        include('../../include/footer.php');
        ?>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $(' #allTransactions').DataTable({
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