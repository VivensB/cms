<div class="row">
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-primary o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-toolbox"></i>
         </div>
         <div class="mr-5">View Users</div>
        
       </div>
       <a class="card-footer text-white clearfix small z-1" href="view_user.php" >
         <span class="float-left">Click</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-warning o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-truck"></i>
         </div>
         <div class="mr-5">Manage Accounts</div>
         <?php
            $query = "SELECT count(*) from user";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
            echo "(" . $row[0] . ")";
            ?>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="manage_account.php">
         <span class="float-left">View Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   
   </div>
 </div>

 
