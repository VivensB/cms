<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../scripts.php');
include('../../base.php');
if (isset($_GET['emp_id'])) {
    $empRef = $_GET['emp_id'];
    $query = mysqli_query($db, "SELECT * FROM employees WHERE empl_ref='$empRef'");
    $result = mysqli_fetch_array($query);
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>QR Code Generator</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="./js/qrcode.js"></script>

   
</head>

<body>
    <div class="row my-5">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg">
                    <h4>QR Code Generator</h4>
                </div>
                <div class="card-body">
                    <form onsubmit="generate();return false;">
                        <div class="form-group">
                            <label for="my-input">Employee Ref Number</label>
                            <input placeholder="Employee Ref Number" value="<?php echo $result['empl_ref']; ?>" disabled
                                readonly type="text" id="refNumber" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="my-input">Employee Name</label>
                            <input placeholder="Employee Name" value="<?php echo $result['name']; ?>" disabled
                                readonly type="text" id="name" class="form-control">
                        </div>
                        <input type="hidden" id="qr" value="<?php echo $result['empl_ref'].'-'.$result['name']; ?>">
                        <input type="submit" class="btn btn-primary" value="Generate QRCode">
                    </form>
                    <div class="my-3" id="qrResult" style="height:400px; width:1100px"></div>
                    <a href="#" type="button" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();" style="margin-top:-400px;">print</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById('qrResult'), {
            width: 200,
            height: 200
        });
        function generate() {
            var message = document.getElementById('qr');
            qrcode.makeCode(message.value);
        }
        function PrintDiv() {
         var divToPrint = document.getElementById('qrResult');
         var popupWin = window.open('', '_blank', 'width=800,height=800');
         popupWin.document.open();
         popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
         popupWin.document.close();}
    </script>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php

include('../../include/footer.php');

?>