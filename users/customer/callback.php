<?php
include("../../include/connect.php");
$_POST = json_decode(file_get_contents('php://input'), true);

$chargeCommission = $_POST["chargeCommission"];
$currency = $_POST["currency"];
$transactionId = $_POST["transactionId"];
$paidAmount = $_POST["paidAmount"];
$status = $_POST["status"];
$statusCode = $_POST["statusCode"];
$responseTime = $_POST["responseTimeStamp"];
$statusDescription = $_POST["statusDescription"];

$select = "SELECT * FROM transactions WHERE transactionId='$transactionId'";
$query = mysqli_query($db, $select);

if (mysqli_num_rows($query) > 0) {
    if ($status == "SUCCESS" && $statusCode == 200) {
        $update = mysqli_query($db, "UPDATE transactions SET status='paid',commission='$chargeCommission' WHERE transactionId='$transactionId'");
        $select_balance = mysqli_query($db, "SELECT * FROM wallet");
        $row = mysqli_fetch_array($select_balance);
        $calc_with_commission = floatval($row[1]) + floatval($paidAmount) - floatval($chargeCommission);
        $update_wallet = mysqli_query($db, "UPDATE wallet SET wallet_balance='$calc_with_commission'");
        if ($update ) {
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode([
                'status' => 'PASS',
                'message' => 'Updated successful.'
            ]);
        } else {
            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode([
                'status' => 'SUCCESS',
                'message' => 'An error occured when updating transaction.'
            ]);
        }
    } else {
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'ERROR',
            'message' => 'Transaction failed, not paid.'
        ]);
    }
} else {
    header('Content-type: application/json');
    http_response_code(200);
    echo json_encode([
        'status' => 'ERROR',
        'message' => 'Transaction does not exist.'
    ]);
}










?>