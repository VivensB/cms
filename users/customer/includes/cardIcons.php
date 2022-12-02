<div class="row">
   
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-warning o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-truck"></i>
         </div>
         <div class="mr-5">Site Progress</div>
         
       </div>
       <a class="card-footer text-white clearfix small z-1" href="site_progress.php">
         <span class="float-left">View Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-success o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-toolbox"></i>
         </div>
         <div class="mr-5">Stock Report</div>
         <?php
              
          ?>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="customer_stock.php">
         <span class="float-left">View Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-danger o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-truck"></i>
         </div>
         <div class="mr-5">Labour Report</div>
         <?php
              $query = "SELECT count(*) from employees";
              $result = mysqli_query($db, $query);
              $row = mysqli_fetch_array($result);
              echo "(" . $row[0] . ")";
          ?>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="employees.php">
         <span class="float-left">View Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
 </div>