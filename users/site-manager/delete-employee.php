<?php
include('../../include/connect.php');
if (isset($_GET['emp_id']))
    $query = mysqli_query($db, "DELETE FROM employees WHERE emp_id='" . $_GET['emp_id'] . "'");
if ($query) {
    echo "<script>alert('Employee Deleted Successful')</script>";
    echo "<script>window.location.href='employee.php'</script>";
}
?>