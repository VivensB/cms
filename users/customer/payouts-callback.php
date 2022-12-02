<?php
include("../../include/connect.php");
$_POST = json_decode(file_get_contents('php://input'), true);

$chargeCommission = $_POST["commission"];
$currency = "RWF";
$transactionId = $_POST["transactionId"];
$paidAmount = $_POST["transferedAmount"];
$status = $_POST["status"];
$statusCode = $_POST["code"];
$statusDescription = $_POST["description"];

$select = "SELECT * FROM transactions WHERE transactionId='$transactionId'";
$query = mysqli_query($db, $select);

if (mysqli_num_rows($query) > 0) {
    if ($status == "SUCCESS") {
        $update = mysqli_query($db, "UPDATE transactions SET status='paid',commission='$chargeCommission' WHERE transactionId='$transactionId'");
        $select_balance = mysqli_query($db, "SELECT * FROM wallet");
        $row = mysqli_fetch_array($select_balance);
        $calc_with_commission = floatval($row[1]) - floatval($paidAmount);
        $update_wallet = mysqli_query($db, "UPDATE wallet SET wallet_balance='$calc_with_commission'");
        $updte_payout = mysqli_query($db, "UPDATE payouts SET status='paid' WHERE transactionId='$transactionId'");
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