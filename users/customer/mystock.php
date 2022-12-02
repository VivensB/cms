<?php
  include('../../include/connect.php');
  include('../../include/header.php');
  include('./includes/sidebar.php');
  include('../../scripts.php');
  include('../../base.php');

  ?>

 <div id="content-wrapper">

   <div class="container-fluid">
     <span id="divToPrint" style="width: 100%;">
       <div style="margin-bottom: 30px">
         <center>
           <h2>Construction Monitoring System</h2><br>
           <h5><u>My stock Records(s)</u></h5>
         </center>

       </div>
       <table border="1" width="100%" cellspacing="0">
       <thead>
            <tr>
            <th width="1%">S/N</th>
              <th width="1%">Item Name</th>
              <th width="1%">Quantity</th>
              <th width="1%">Measure</th>
              <th width="1%">cost</th>
              <th width="1%"">total</th>
              <th width="1%">Date</th>
           
            </tr>
          </thead>

         <?php
         $a=1;

$query = "SELECT i.*, m.`name` as measure FROM item i LEFT JOIN measure m ON m.`m_id` = i.`measure_id`";
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {

  echo '<tr>';
  echo '<td>' . $a++. '</td>';
  echo '<td>' . $row['item_name'] . '</td>';
  echo '<td>' . $row['quantity'] . '</td>';
  echo '<td>' . $row['measure'] . '</td>';
  echo '<td>' . $row['cost'] . '</td>';
  echo '<td>' . $row['total'] . '</td>';
  echo '<td>' . $row['date'] . '</td>';}

          ?>

       </table>
     </span>
     <br>
     <center>
       <div style="float: center;">
         <a href="#" type="button" class="btn btn-xs btn-info fas fa-print" value="print" onclick="PrintDiv();">print</a>
       </div>
     </center>
     <script type="text/javascript">
       function PrintDiv() {
         var divToPrint = document.getElementById('divToPrint');
         var popupWin = window.open('', '_blank', 'width=800,height=800');
         popupWin.document.open();
         popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
         popupWin.document.close();
       }
     </script>
   </div>
 </div>


 <?php

  include('../../include/footer.php');
  ?>