<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../scripts.php');
include('../../base.php');

?>

<style>
  .error {
    border: 1px solid red;
    border-radius: 5px;
    padding: 13px;
    color: red;
    background: #FEDADA;
    font-weight: bold;
  }
</style>

<div id="content-wrapper">

  <div class="container-fluid">
    <div class="row">
      <div class="col col-10">
        <h2>Stock Item List</h2>
      </div>
   
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Item Name</th>
              <th>Quantity</th>
              <th>Measure</th>
              <th>cost</th>
              <th>total</th>
              <th>Date</th>
              
            </tr>
          </thead>

          <?php

          $query = "SELECT i.*, m.`name` as measure FROM item i LEFT JOIN measure m ON m.`m_id` = i.`measure_id`";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));

          while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';
            echo '<td>' . $row['item_name'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            echo '<td>' . $row['measure'] . '</td>';
            echo '<td>' . $row['cost'] . '</td>';
            echo '<td>' . $row['total'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo " ";
           
          ?>
            <div id="UpdateEmployee<?php echo $row['item_id']; ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header">
                    <h3>Modify Item</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">


                    <form method="POST" action="#">
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="inputName1" class="form-control" placeholder="Name" name="name" value="<?= $row['item_name']; ?>" autofocus="autofocus" required>
                          <input type="hidden" id="inputName1" class="form-control" name="id" value="<?= $row['item_id']; ?>" autofocus="autofocus" required>
                          <label for="inputName1">Name</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="form-label-group">
                          <input type="text" id="inputAddress1" class="form-control" placeholder="Address" value="<?= $row['cost']; ?>" name="cost" required>
                          <label for="inputAddress1">Cost</label>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="form-label-group">

                          <p>Measure</p>

                          <select style="margin-left:px;" name="measure" class="form-control">
                            <option>-----Select Any Item--- </option>
                            <?php

                            $results = mysqli_query($db, "SELECT * FROM measure");
                            while ($rows = mysqli_fetch_array($results)) { ?>
                              <option value="<?= $rows['m_id']; ?>"><?= $rows['name']; ?> </option>
                            <?php } ?>
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
              </div>
            </div>
            <?php

            if (isset($_POST['update'])) {
              $id = $_POST['id'];
              $name = $_POST['name'];
              $cs = $_POST['cost'];
              $msr = $_POST['measure'];

              date_default_timezone_set("Asia/Manila");
              $date1 = date("Y-m-d H:i:s");

              $remarks = "Item $name was updated";
              $query = "UPDATE `item` SET `item_name`='$name',`cost`='$cs', `measure_id`='$msr' WHERE `item_id`='$id'";
              mysqli_query($db, $query) or die(mysqli_error($db));
              mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));

            ?>
              <script type="text/javascript">
                alert("Item Updated Successfully!.");
                window.location = "Item.php";
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
    <div id="AddItem" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 130%">
          <div class="modal-header">
            <h3>Add New Item</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">

            <form method="POST" action="#">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" autofocus="autofocus" required>
                  <label for="inputName">Name</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">

                  <p>Measure</p>

                  <select style="margin-left:px;" name="measure" class="form-control">
                    <option>-----Select Any Item--- </option>
                    <?php

                    $query = "SELECT * FROM measure";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <option value="<?= $row['m_id']; ?>"><?= $row['name']; ?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputAddress" class="form-control" placeholder="Address" name="cost" required>
                  <label for="inputAddress">Cost/Unit price</label>
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
      $cs = $_POST['cost'];
      $msr = $_POST['measure'];


      date_default_timezone_set("Asia/Manila");
      $date1 = date("Y-m-d H:i:s");

      $sql = "SELECT* FROM item WHERE item_name='$name' AND cost='$cs'";
      $res = mysqli_query($db, $sql);
      $row = mysqli_num_rows($res);
      if ($row > 0) {

    ?>
        <script type="text/javascript">
          window.alert('Data Already inserted');
        </script>
      <?php
        die();
      } else {
        $remarks = "Item $name was Added";
        $query = "INSERT INTO item(item_name,measure_id,quantity,cost,total)
                  VALUES ('$name','$msr',0,'$cs','0')";
        mysqli_query($db, $query) or die("<span  class='error'>" . mysqli_error($db) . "</span>");
        mysqli_query($db, "INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')") or die(mysqli_error($db));

      ?>
        <script type="text/javascript">
          alert("Item Added Successfully!.");
          window.location = "Item.php";
        </script>
    <?php

      }
    }

    include('../../include/footer.php');

    ?>