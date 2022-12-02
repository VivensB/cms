<?php

include('../../include/connect.php');
    include('../../include/header.php');
    include('./includes/sidebar.php');
    include('../../base.php');
    include('../../scripts.php');?>

    <div id="content-wrapper">
    <div class="container-fluid">
        <h2>Datas of user(s)</h2>
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>username</th>
                            <th>Password</th>
                            <th>position</th>
                          
                        </tr>
                    </thead>

                    <?php

                    $query = "SELECT * FROM user";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo '<tr>';
                        
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['gender'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['tel'] . '</td>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>' . $row['password'] . '</td>';
                        echo '<td>' . $row['user_type'] . '</td>';
                        echo " ";
                        
   
                           
                    
                    }
                    
                    
                    include('../../include/footer.php'); 
                    
                    ?>