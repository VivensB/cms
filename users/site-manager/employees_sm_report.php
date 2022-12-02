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
           <h5>List of Employee(s)</h5>
         </center>

       </div>
       <table border="1" width="100%" cellspacing="0">
         <thead>
           <tr>
             <th>Name</th>
             <th>Age</th>
             <th>Address</th>
             <th>Contact Number</th>
             <th>Position</th>
           </tr>
         </thead>

         <?php

          $query = "SELECT * FROM employees WHERE `status` ='active'";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));

          while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['contact_number'] . '</td>';
            echo '<td>' . $row['position'] . '</td>';
            echo '</tr> ';
          }

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