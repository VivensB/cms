<?php
include('../../include/connect.php');
$_POST = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set("Africa/Kigali");
$date1 = date("Y-m-d");
$amount = $_POST["amount"];
$phone = $_POST["phone"];
$transactionId = $_POST["txId"];
$empRef = $_POST["empRef"];
$empName = $_POST["name"];
$paid_date = date("Y-m-d h:i:s");
$wBalance = $_POST["walletBalance"];

$insertTransaction = "INSERT INTO transactions(transactionId,amount,commission,currency,payment_method,transaction_type,phone,status) VALUES ('$transactionId','$amount','0','RWF','MOMO','debit','$phone','pending')";
$insertPayout = "INSERT INTO payouts(amount,transactionId,emp_ref,emp_name,status,paid_date) VALUES('$amount','$transactionId','$empRef','$empName','pending','$date1')";
$queryTransaction = mysqli_query($db, $insertTransaction);
$queryPayout = mysqli_query($db, $insertPayout);
if ($queryTransaction && $queryPayout) {
    echo 'Payout generted successful, please continue confrimation quickly.';
} else {
    echo 'Something went wrong while initiating transaction.';
}

?>