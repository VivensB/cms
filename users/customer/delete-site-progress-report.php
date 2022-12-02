<?php
include('../../include/connect.php');
if (isset($_GET['report']))
    $query = mysqli_query($db, "DELETE FROM site_progress WHERE id='".$_GET['report']."'");
if ($query) {
    echo "<script>alert('Report has been removed successful')</script>";
    echo "<script>window.location.href='site_progress.php'</script>";
}
?>