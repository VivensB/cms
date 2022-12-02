<?php

include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../scripts.php');
include('../../base.php');
?>

<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">

  <div class="container-fluid">
    <div class="row">
      <div class="col col-10">
        <h2>Stock Out History</h2>
      </div>
      <div class="col">
        <a href="#" data-toggle="modal" data-target="#AddReq" class="btn btn-danger">Request New item</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="EngRequests" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Tool(s)</th>
              <th>Quantity</th>
              <th>Date/Time Out</th>
              <th>Taken By</th>
              <th>Approval</th>
            </tr>
          </thead>
          <tbody>
            <?php

          $query = "SELECT st.*, i.`item_name`,m.`name` as measure, e.`name` as employee  FROM stock_movement st 
                    JOIN item i ON `i`.`item_id` = st.`item_id`
                    JOIN measure m ON m.`m_id` = i.`measure_id` 
                    JOIN employees e ON e.`emp_id` = st.`employee_id`
                    WHERE st.`action` = 'out'";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));
          $a = 1;
          while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';
            echo '<td>' . $a++ . '</td>';
            echo '<td>' . $row['item_name'] . '</td>';
            echo '<td>' . $row['quantity'] . ' ' . $row['measure'] . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '<td>' . $row['employee'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
          } ?>


            <div id="AddReq" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header">
                    <h3>Remove Item in Stock</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="#">
                      <div class="form-group">
                        <div class="form-label-group">

                          <p>Item name</p>

                          <select style="margin-left:px;" name="name" class="form-control">
                            <option>-----Select Any Item--- </option>
                            <?php

                          $query = "SELECT * FROM item";
                          $result = mysqli_query($db, $query) or die(mysqli_error($db));
                          while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?= $row['item_id']; ?>">
                              <?= $row['item_name']; ?>
                            </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="number" id="inputAge" class="form-control" placeholder="Age" name="quantity"
                            required>
                          <label for="inputAge">Quantity</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">

                          <p>Assigned Employee</p>

                          <select style="margin-left:px;witdh:30px;" name="employee" required class="form-control">
                            <option>-----Select Employee</option>
                            <?php

                          $query = "SELECT * FROM employees WHERE `status` = 'active'";
                          $result = mysqli_query($db, $query) or die(mysqli_error($db));
                          while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?= $row['emp_id']; ?>">
                              <?= $row['name']; ?>
                            </option>
                            <?php } ?>
                          </select>
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
            </tr>
          </tbody>
        </table>
          <?php
          if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $qty = $_POST['quantity'];
            $emp_id = $_POST['employee'];

            date_default_timezone_set("Asia/Manila");
            $date1 = date("Y-m-d H:i:s");
            $result = mysqli_query($db, "SELECT * FROM item WHERE item_id = $name") or die(mysqli_error($db));
            $item_res = mysqli_fetch_array($result);
            if ($item_res['quantity'] < $qty) {
          ?>
          <script type="text/javascript">
            alert("Sorry!! we don't have that Quantity in stock ");
          </script>
          <?php
              die();
            } else if ($qty <= 0) {
          ?>
          <script type="text/javascript">
            alert("Sorry!! Check quantity you want and try again ");
          </script>
          <?php
              die();
            } else {
              $remarks = "Item " . $item_res['item_name'] . " withdrown from stock_movement";
              $operator = $_SESSION['userId'];
              $res = mysqli_query($db, "INSERT INTO stock_movement(item_id,quantity,`action`,employee_id,oparetor,status) VALUES ('$name','$qty','pending','$emp_id',$operator,'pending')") or die(mysqli_error($db));
            }
            if ($res) {
          ?>
          <script type="text/javascript">
            alert("Stockout item request has been added successful please wait for approval.");
            window.location = "day_tool.php";
          </script>
          <?php
            }
          }

          include('../../include/footer.php');

          ?>
          <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
          <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
          <script>
            $(document).ready(function () {
              $(' #EngRequests').DataTable({
                language: {
                  paginate: {
                    previous: '<i class="bx bx-chevron-left"></i>'
                    , next: '<i class="bx bx-chevron-right"></i>',
                  },
                  searchPlaceholder: "Search a request ...",
                  emptyTable: "No stock requests available.",
                },
              });
            }); </script>