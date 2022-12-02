<?php
include('../../include/connect.php');
if (
    isset($_GET['historyId'])
    && isset($_GET['qty'])
    && isset($_GET['cost'])
    && isset($_GET['item_name'])
    && isset($_GET['item_id'])
) {
    date_default_timezone_set("Africa/Kigali");
    $date1 = date("Y-m-d H:i:s");
    $historyId = $GET['historyId'];
    $quantity = $GET['quantity'];
    $cost = $_GET['cost'];
    $item_name = $_GET['item_name'];
    $itemId = $_GET['item_id'];
    $selectExistStock = mysqli_query($db, "SELECT * FROM item WHERE item_id='".$_GET['item_id']."'");
    $rowQuery = mysqli_fetch_array($selectExistStock);
    $checkApproved = mysqli_query($db, "SELECT * FROM stock_movement WHERE id='".$GET['historyId']."'");
    $checkAppRow = mysqli_fetch_array($checkApproved);
    $newQty = $rowQuery['quantity'] - $_GET['qty'];
    $newTotal = $_GET['cost'] * $newQty;
    $remarks = "Item " . $item_name . " withdrawn from stock_movement";
    /** Update stock query */
    if ($checkAppRow['status'] == 'approved' && $checkAppRow['action'] == 'out') {
        echo "<script>alert('Sorry this request has been already approved.')</script>";
        header("day_tool.php");
    } else {
        $query1 = mysqli_query($db, "UPDATE item SET quantity = '$newQty', total = '$newTotal' WHERE item_id = '$itemId'") or die(mysqli_error($db));
        $query2 = mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
        $query3 = mysqli_query($db, "UPDATE stock_movement SET status='approved',action='out' WHERE id='" . $_GET['historyId']."'");
        if ($query1 && $query2 && $query3) {
            echo "<script>alert('Stock request approved successful')</script>";
            echo "<script>window.location.href='day_tool.php'</script>";
        } else {
            echo "<script>alert('Oops, Something went wrong, stock request not approved.')</script>";
            echo "<script>window.location.href='day_tool.php'</script>";
        }
    }
}
?>