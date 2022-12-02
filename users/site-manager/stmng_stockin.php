<?php

include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../scripts.php');
include('../../base.php');
?>


<!-- DataTables Example -->
<!-- DataTables Example -->
<div id="content-wrapper">

  <div class="container-fluid">
    <div class="row">
      <div class="col col-10">
        <h2>Stock In History</h2>
      </div>
      <div class="col">
        <a href="#" data-toggle="modal" data-target="#AddReq" class="btn btn-success">Add New item</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Tool(s)</th>
              <th>Quantity</th>
              <th>Date/Time In</th>
              <th>Oparetor</th>

            </tr>
          </thead>
          <?php

          $query = "SELECT st.*, i.`item_name`,m.`name` as measure, u.`name` as employee  FROM stock_movement st 
                    JOIN item i ON `i`.`item_id` = st.`item_id`
                    JOIN measure m ON m.`m_id` = i.`measure_id` 
                    JOIN user u ON u.`user_id` = st.`oparetor`
                    WHERE st.`action` = 'in'";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));
          $a = 1;
          while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';
            echo '<td>' . $a++ . '</td>';
            echo '<td>' . $row['item_name'] . '</td>';
            echo '<td>' . $row['quantity'] . ' ' . $row['measure'] . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '<td>' . $row['employee'] . '</td>';
          } ?>


          <div id="AddReq" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content" style="width: 130%">
                <div class="modal-header">
                  <h3>Add Item in Stock</h3>
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
                            <option value="<?= $row['item_id']; ?>"><?= $row['item_name']; ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-label-group">
                        <input type="number" id="inputAge" class="form-control" placeholder="Age" name="quantity" required>
                        <label for="inputAge">Quantity</label>
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
            $qty = $_POST['quantity'];


            date_default_timezone_set("Asia/Manila");
            $date1 = date("Y-m-d H:i:s");
            $result = mysqli_query($db, "SELECT * FROM item WHERE item_id = $name") or die(mysqli_error($db));
            $item_res = mysqli_fetch_array($result);
            $remarks = "Item ". $item_res['item_name']." added in stock_movement";
            $operator = $_SESSION['userId'];
            $res = mysqli_query($db, "INSERT INTO stock_movement(item_id,quantity,`action`,oparetor) VALUES ('$name','$qty','in','$operator')") or die(mysqli_error($db));
            // echo $name. " - ". $qty;
            if ($res) {
              $newQty = $item_res['quantity'] + $qty;
              $newTotal = $item_res['cost'] * $newQty;
              mysqli_query($db, "UPDATE item SET quantity = '$newQty', total = '$newTotal' WHERE item_id = '$name'") or die(mysqli_error($db));
              mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));
          ?>
              <script type="text/javascript">
                alert("Item Added in stock Successfully!. ");
                window.location = "stmng_stockin.php";
              </script>
          <?php
            }
          }

          include('../../include/footer.php');

          ?>