<?php
    include('../../include/connect.php');
    include('../../include/header.php');
    include('./includes/sidebar.php');
    require('../../base.php');
?>
<div class="m-4">
  <form method="post" action>
    <div class="container-fluid">
      <h2>Stock Item Requistion Form<a href="#" data-toggle="modal" data-target="#AddEmployee" class="btn btn-sm btn-info ml-4">Add New</a></h2>
      <div class="card-body">
        <div class="table-responsive ml-0">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Item NAME</th>
                <th>Quantity</th>
                <th>Employee Assigned</th>
                <th>Date/time Out</th>
                <th>Options</th>
              </tr>
            </thead>
            <?php
            $query = "SELECT * FROM stock ";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              echo '<tr>';
              echo '<td>' . $row['item_name'] . '</td>';
              echo '<td>' . $row['quantity'] . $row['measure'] . '</td>';
              echo '<td>' . $row['employee_name'] . '</td>';
              echo '<td>' . $row['out_date'] . '</td>';
              echo " ";
              echo '<td><a type="button" class="btn btn-sm btn-warning fa fa-edit fw-fa" href="#" data-toggle="modal" data-target="#UpdateEmployee' . $row['stc_id'] . '">Edit</a>';
            }
            ?>
            <div id="UpdateEmployee<?php echo $row['stc_id']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header">
                    <h3>Modify Employee</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="#">
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="inputName1" class="form-control" placeholder="Name" name="name" value="<?php echo $row['name']; ?>" autofocus="autofocus" required>
                          <input type="hidden" id="inputName1" class="form-control" name="id" value="<?php echo $row['emp_id']; ?>" autofocus="autofocus" required>
                          <label for="inputName1">Name</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="number" id="inputAge1" class="form-control" placeholder="Age" name="age" value="<?php echo $row['age']; ?>" required>
                          <label for="inputAge1">Age</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="inputAddress1" class="form-control" placeholder="Address" value="<?php echo $row['address']; ?>" name="add" required>
                          <label for="inputAddress1">Address</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="inputContact1" class="form-control" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" name="contact" required>
                          <label for="inputContact1">Contact Number</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="position" class="form-control" placeholder="Position" value="<?php echo $row['position']; ?>" name="position" required>
                          <label for="position">Position</label>
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
              </div>
            </div>
            <?php

            if (isset($_POST['update'])) {
              $id = $_POST['id'];
              $name = $_POST['name'];
              $age = $_POST['age'];
              $add = $_POST['add'];
              $contact = $_POST['contact'];
              $position = $_POST['position'];


              date_default_timezone_set("Asia/Manila");
              $date1 = date("Y-m-d H:i:s");

              $remarks = "employee $name was updated";
              $query = "UPDATE `employees` SET `name`='$name',`age`='$age',`address`='$add',`contact_number`='$contact',`position`='$position' WHERE `emp_id`='$id'";
              mysqli_query($db, $query) or die(mysqli_error($db));
              mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));

            ?>
              <script type="text/javascript">
                alert("Employee Updated Successfully!.");
                window.location = "employees.php";
              </script>
            <?php
              echo '</td> ';
              echo '</tr> ';
            }
            ?>
          </table>
        </div>
      </div>
  </form>
</div>
<div id="AddEmployee" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="width: 130%">
      <div class="modal-header">
        <h3>Make A Request</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="#">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" autofocus="autofocus" required>
              <label for="inputName">Requisition Name</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="date" id="sate" class="form-control" placeholder="Date" name="date" required>
              <label for="inputAge">date</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" autofocus="autofocus" required>
              <label for="inputName">Item Name</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputAddress" class="form-control" placeholder="qty" name="quantity" required>
              <label for="inputAddress">Quantity</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputContact" class="form-control" placeholder="Cost per unit" name="cost" required>
              <label for="inputContact">cost/unit</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="position1" class="form-control" placeholder="amount" name="total" required>
              <label for="position1">total</label>
            </div>
          </div>
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
  $dt = $_POST['date'];
  $qty = $_POST['quantity'];
  $ct = $_POST['cost'];
  $Amt = $_POST['total'];

  date_default_timezone_set("Asia/Manila");
  $date1 = date("Y-m-d H:i:s");

  $remarks = "Item $name was Added";
  $query = "INSERT INTO item(item_name,quantity,cost,total,date,'') VALUES ('" . $name . "','" . $dt . "','" . $qty . "','" . $ct . "','" . $Amt . "','')";
  mysqli_query($db, $query) or die(mysqli_error($db));
  mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));

?>
  <script type="text/javascript">
    alert("New Employee Added Successfully!.");
    window.location = "item.php";
  </script>

<?php } ?>


<?php

include('../../scripts.php');
include('../../include/footer.php');

?>