<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
include('../../libs.php');
include('../../scripts.php');
?>
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div class="container-fluid ">
  <div class="col-lg-12">
    <div class="card my-5">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8">
            <span><b>Attendance List</b></span>
          </div>
          <div class="col-md-2">
            <a href="qr_attendance.php" class="btn btn-primary btn-block btn-sm" type="button">
              <span class="fa fa-plus"></span>
              Add Attendance
            </a>
          </div>
          <div class="col-md-2">
            <a href="qrcode.php" class="btn btn-primary btn-sm btn-block" type="button">
              <span class="fa fa-plus"></span>
              Generate QR Code
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive my-5">
          <table 
                id="table" 
                style="font-size:12px !important;" 
                class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Time Records (AM)</th>
                <th>Time Records (PM)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = ("SELECT*FROM attendance ");
              $result = mysqli_query($db, $query) or die(mysqli_error($db));

              while ($row = mysqli_fetch_assoc($result)) {
                $row['att_id'];
                echo '<tr>';
                echo '<td>' . $row['logdate'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . 'Timein AM' . '<br>' . $row['Timein'] . '<br>' . 'Timeout AM' . '<br>' . $row['Timeout'] . '</td>';
                echo '<td>' . 'Timein PM' . '<br>' . $row['Timein_PM'] . '<br>' . 'Timeout PM' . '<br>' . $row['Timeout_PM'] . '</td>';
                echo '</tr>';
              }
              if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $typ = $_POST['type'];
                $time = date("Y-m-d H:i:s");
                if ($typ == "AMO") {
                  date_default_timezone_set("Asia/Manila");
                  $date1 = date("Y-m-d H:i:s");
                  $remarks = "Attendence $name was updated";
                  $query = "UPDATE `attendance` SET `Timeout_AM`='$time' WHERE `att_id`='$id'";
                  mysqli_query($db, $query) or die(mysqli_error($db));
                  mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
              ?>
              <script type="text/javascript">
                alert("Attendance Updated Successfully!.");
                window.location = "attendence.php";
              </script>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $(' #table').DataTable({
      language: {
        paginate: {
          previous: '<i class="bx bx-chevron-left"></i>'
          , next: '<i class="bx bx-chevron-right"></i>',
        },
        searchPlaceholder: "Search attendance ...",
        emptyTable: "No attendance available.",
      },
    });
  }); </script>
<!-- attendance modal -->
<div id="new_attendance_btn" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="width: 130%">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <label>SCAN QR CODE</label>
            <input type="text" name="text" id="text" readonly="" placeholder="scan qr code" class="form-control">
          </div>
        </div>
      </div>
      <video id="preview"></video>
      <script type="text/javascript" src="js/adapter.min.js" src="js/vue.min.js" src="js/instascan.min.js">
        let scanner = new Instascan.Scanner({
          video: document.getElementById('preview')
        });
        scanner.addListener('scan', function (content) {
          console.log(content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });

        scanner.addListener('scan', function (c) {
          document.getElementById('text').value - c;
        })
      </script>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Close
          <span class="glyphicon glyphicon-remove-sign"></span>
        </button>
        <input type="submit" name="submit" value="Save" class="btn btn-success">
      </div>
      </form>

    </div>
  </div>
</div>
</div>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $typ = $_POST['type'];
  $time = date("Y-m-d H:i:s");
  if ($typ == 'AMI') {

    $date1 = date("Y-m-d H:i:s");
    $remarks = "Item $name withdrawn from stock";
    $query = "INSERT INTO attendence(name,Timein_AM,) VALUES (' ',' ','" . $name . "','" . $time . "')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
?>

<?php
  }
}
include("../../include/footer.php")
?>