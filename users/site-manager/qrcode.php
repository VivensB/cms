<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../scripts.php');
include('../../base.php');
?>
<html>

<head>
  <meta charset="utf-8">
  <title>QR Code Generator</title>
</head>

<body>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg">
            <h1>QR Code Generator</h1>
          </div>
          <div class="card-body">
            <form method="POST">
              <input placeholder="Enter Employee Ref Number" name="refNo" type="text" class="form-control"><br><br>
              <button type="submit" name="submitChecking" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
if (isset($_POST["submitChecking"])) {
  $refNo = $_POST["refNo"];
  if (empty($refNo)) {
    echo '<script>alert("Employee reference No is required.")</script>';
  } else {
    $select = mysqli_query($db, "SELECT * FROM employees WHERE empl_ref ='$refNo'");
    if (mysqli_num_rows($select) > 0) { ?>
<script>
  window.location.href = "qr-generator.php?emp_id=<?php echo $refNo; ?>";
</script>
<?php } else {
      echo '<script>alert("Employee does not exist.")</script>';
    }
  }
}

include('../../include/footer.php');
?>