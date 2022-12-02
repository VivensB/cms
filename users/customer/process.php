<?php
//session_start();
// Create connection
include('../../include/connect.php');
// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
    $total = 0;
    $update = false;
    $id=0;
    $name = '';
    $amount = '';
    if(isset($_POST['save'])){
        $budget = $_POST['budget'];
        $amount = $_POST['amount'];
        $query = mysqli_query($db, "INSERT INTO budget (name, amount) VALUE ('$budget', '$amount')"); 
        $_SESSION['massage'] = "Recode has been saved !";
        $_SESSION['msg_type'] = "primary";
        header("location: budget.php?result=true");
    }
    //calculate Total budget
    $result = mysqli_query($db, "SELECT * FROM budget");
    while($row = $result->fetch_assoc()){
        $total = $total + $row['amount'];
    }
    //delete data
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $query = mysqli_query($db, "DELETE FROM budget WHERE id=$id");
        if($query>0){
            echo "<script>alert('date deleted successfully')</script>";
            header("location: budget.php");
        }
    }
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = mysqli_query($db, "SELECT * FROM budget WHERE id=$id");
        if( mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $amount = $row['amount'];
        }
    }
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $budget = $_POST['budget'];
        $amount = $_POST['amount'];
        $query = mysqli_query($db, "UPDATE budget SET name='$budget', amount='$amount' WHERE id='$id'");
        $_SESSION['massage'] = "Recode has been Update !";
        $_SESSION['msg_type'] = "success";
        header("location: budget.php");
    }
?>

