<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../base.php');
if (isset($_POST['reportDate'])) {
    $reportDate = $_POST['reportDate'];
}
?>
<div id="content-wrapper">
    <div class="container-fluid">
        <span id="divToPrint" style="width: 100%;">
            <div style="margin-bottom: 30px">
                <center>
                    <h2>Construction Monitoring System</h2><br>
                    <h5> Payment Report on <?php echo date("d/m/Y", strtotime($reportDate)); ?> </h5>
                </center>
            </div>
            <table width="100%" cellspacing="0" border="1">
                <thead>
                    <tr>
                        <th>Transaction Payment Batch</th>
                        <th>Employee Reference No</th>
                        <th>Employee Name</th>
                        <th>Amount (RWF)</th>
                        <th>Paid Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php
        $query = "SELECT * FROM payouts where paid_date='$reportDate'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['transactionId'] . '</td>';
            echo '<td>' . $row['emp_ref'] . '</td>';
            echo '<td>' . $row['emp_name'] . '</td>';
            echo '<td>' . number_format($row['amount'], 2, '.', ',') . '</td>';
            echo '<td>' . $row['paid_date'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr> ';
        }
        ?>
            </table>
        </span>
        <br>
        <center>
            <div style="float: center;">
                <a href="#" type="button" class="btn btn-xs btn-info" value="print" onclick="PrintDiv();">
                    <i class="fas fa-print"></i>
                </a>
            </div>
        </center>
        <script type="text/javascript">
            function PrintDiv() {
                var divToPrint = document.getElementById('divToPrint');
                var popupWin = window.open('', '_blank', 'width=800,height=800');
                popupWin.document.open();
                popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                popupWin.document.close();
            }
        </script>
    </div>
</div>
<?php
include('../../scripts.php');
include('../../include/footer.php');
?>