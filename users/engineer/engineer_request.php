<?php 
include('include/connect.php');
include('include/header.php');
include('user/include/sidebar1.php');
?>
<div>
<form method="post" action>



 <div class="container-fluid">
 <h2>Stock Item Record(s)<a href="#" data-toggle="modal" data-target="#AddEmployee" class="btn btn-sm btn-info">Add New</a></h2> 
           

 <div id="AddEmployee" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header"><h3>Add New Employee</h3>
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
                            <input type="number" id="inputAge" class="form-control" placeholder="Age" name="age" required>
                            <label for="inputAge">Subject</label>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="form-label-group">
                            <textarea  id="inputAddress" class="form-control" placeholder="Compose message" name="message" required></textarea>
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
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $age = $_POST['age'];
  $add = $_POST['add'];
  $contact = $_POST['contact'];
  $position = $_POST['position'];

  date_default_timezone_set("Asia/Manila"); 
  $date1 = date("Y-m-d H:i:s");

 $remarks="employee $name was Added";  
  $query = "INSERT INTO employees(name,age,address,contact_number,position)
                VALUES ('".$name."','".$age."','".$add."','".$contact."','".$position."')";
                mysqli_query($db,$query)or die (mysqli_error($db));
  mysqli_query($db,"INSERT INTO logs(action,date_time) VALUES('$remarks','$date1')")or die(mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("New Employee Added Successfully!.");
      window.location = "employees.php";
    </script>
    <?php
}

              include('include/scripts.php');
       include('include/footer.php');
       
        ?>