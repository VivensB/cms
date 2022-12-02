<?php
include('../../include/connect.php');
$_POST = json_decode(file_get_contents('php://input'), true);

$amount = $_POST["amount"];
$phone = $_POST["phone"];
$transactionId = $_POST["txId"];

$insert = "INSERT INTO transactions(transactionId,amount,commission,currency,payment_method,transaction_type,phone,status) VALUES ('$transactionId','$amount','0','RWF','MOMO','credit','$phone','unpaid')";
$query = mysqli_query($db, $insert);
if ($query) {
    echo 'Transaction created successful, please continue confrimation quickly.';
} else {
    echo 'Something went wrong while initiating transaction.';
}
?>