<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../base.php');
include('../../scripts.php');
include('../../libs.php');
?>
<div class="container-fluid ">
  <div class="col-lg-12">
    <br />
    <br />
    <div class="card">
      <div class="card-header">
        <span><b>Attendance List</b></span>
      </div>
      <div class="card-body">
        <table style="font-size: 13px;" id="table" class="table table-bordered table-striped">
          <colgroup>
            <col width="10%">
            <col width="10%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
          </colgroup>
          <thead>
            <tr>
              <th>Date</th>
              <th>Name</th>
              <th colspan="2">
                <center>Time Record</center>
              </th>
              <th>Action</th>
            </tr>
          </thead>
          <?php
          $query = ("SELECT*FROM attendance ");
          $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while ($row = mysqli_fetch_assoc($result)) {
            $row['att_id'];
            echo '<tr>';
            echo '<td>' . $row['logdate'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . 'Timein AM' . '<br>' . $row['Timein'] . '</td>' . '<td>' . 'Timein AM' . '<br>' . $row['Timeout'] . '</td>';
            echo " ";
            echo '<td >
                  <a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#UpdateEmployee' . $row['att_id'] . '">Edit</a>
                  
                  </td>
                ';

          ?>
          <div id="UpdateEmployee<?php echo $row['att_id']; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content" style="width: 130%">
                <div class="modal-header">
                  <h3>Modify Attedence</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="#">
                    <div class="form-group">
                      <div class="form-label-group">
                        <input type="text" id="inputName1" class="form-control" placeholder="Name" name="name"
                          value="<?php echo $row['name']; ?>" autofocus="autofocus" required>
                        <input type="hidden" id="inputName1" class="form-control" name="id"
                          value="<?php echo $row['emp_id']; ?>" autofocus="autofocus" required>
                        <label for="inputName1">Name</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-label-group">
                        <p>Type</p>
                        <select name="type" id="type" class="borwser-default custom-select">
                          <option>-----Select Time Format--- </option>
                          <option value="AMI">----Time In- AM </option>
                          <option value="AMO">-----Time Out- AM </option>
                          <option value="PMI">----Time In- PM </option>
                          <option value="PMO">-----Time Out- PM </option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                        <span class="glyphicon glyphicon-remove-sign"></span>
                      </button>
                      <input type="submit" name="update" value="Update" class="btn btn-success">
                    </div>
                  </form>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <?php
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
            window.location = "Attendence.php";
          </script>
          <?php
            }
            echo '</td> ';
            echo '</tr> ';
          }
          ?>
        </table>
      </div>
    </div>
    </table>
  </div>
</div>
</div>

</div>




<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      pageLength: 5,
      lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
  });
</script>



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
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
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

        scanner.addListener('scan', function (c)){
          document.getElementById('text').value - c;

        }
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
    date_default_timezone_set("Asia/Manila");
    $date1 = date("Y-m-d H:i:s");

    $remarks = "Item $name withdrown from stock";
    $query = "INSERT INTO attendence(name,Timein_AM,) VALUES (' ',' ','" . $name . "','" . $time . "')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));

?>
<script type="text/javascript">
  alert("Attendence Added Successfully!.");
  window.location = "Item.php";
</script>
<?php
  }
}




?>