<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
?>
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<div id="content-wrapper">
    <div class="container">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <form method="post" action="payment-report.php">
                        <div class="form-group">
                            <label for="">Payment Report By Date</label>
                            <input type="date" class="form-control" name="reportDate" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include('../../scripts.php');
        include('../../include/footer.php');
        ?>