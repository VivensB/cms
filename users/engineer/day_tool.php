<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../scripts.php');
require('../../base.php');
?>
<!-- DataTables Example -->
<!-- DataTables Example -->
<style>
  .actionIn {
    border: 1px solid green !important;
    padding: 5px 20px 5px 20px !important;
    border-radius: 5px !important;
    min-width: 20px !important;
  }

  .actionOut {
    border: 1px solid red !important;
    padding: 5px 20px 5px 20px !important;
    border-radius: 5px !important;
    min-width: 20px !important;
  }
</style>

<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col col-8">
        <h2>Stock History</h2>
      </div>
      <div class="col">
        <div class="row">

          <a href="stmng_stockout.php" class="btn btn-danger" style="margin-left: 5px;">Stock Out</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="stockHistory" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Date & Time</th>
              <th>Tool(s)</th>
              <th>Quantity</th>
              <th>Action</th>
              <th>Asigned To</th>
              <th>Done By</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT st.*, i.`item_name`,m.`name` as measure, u.`name` as doneBy, COALESCE(e.`name`, '-') as employee  FROM stock_movement st 
                        JOIN item i ON `i`.`item_id` = st.`item_id`
                        JOIN measure m ON m.`m_id` = i.`measure_id` 
                        LEFT JOIN user u ON u.`user_id` = st.`oparetor`
                        LEFT JOIN employees e ON e.`emp_id` = st.`employee_id`";
              $result = mysqli_query($db, $query) or die(mysqli_error($db));
              $a = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $a++ . '</td>';
                echo '<td>' . $row['created_at'] . '</td>';
                echo '<td>' . $row['item_name'] . '</td>';
                echo '<td>' . $row['quantity'] . ' ' . $row['measure'] . '</td>';
                echo $row['action'] == 'in' ? '<td><span class="actionIn">' . $row['action'] . '</span></td>' : '<td><span class="actionOut">' . $row['action'] . '</span></td>';
                echo '<td>' . $row['employee'] . '</td>';
                echo '<td>' . $row['doneBy'] . '</td>';
              }
              include('../../include/footer.php');
              ?>
            </tr>
          </tbody>
        </table>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
          $(document).ready(function () {
            $(' #stockHistory').DataTable({
              language: {
                paginate: {
                  previous: '<i class="bx bx-chevron-left"></i>'
                  , next: '<i class="bx bx-chevron-right"></i>',
                },
                searchPlaceholder: "Search history ...",
                emptyTable: "No stock history available.",
              },
            });
          }); </script>