<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
if (isset($_GET['report'])) {
    $reportId = $_GET['report'];
    $select = "SELECT * FROM site_progress WHERE id='$reportId'";
    $query = mysqli_query($db, $select);
    $result = mysqli_fetch_array($query);
}
?>
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<div id="content-wrapper">
    <div class="container-fluid">
        <h4>Site Progress Report</h4>
        <hr>
        <div class="container my-5">
            <div class="form-group">
                <label for="">
                    <?php echo $result['report_title']; ?>
                </label>
                <textarea id="summernote" required class="form-control" name="siteProgress">
                        <?php echo $result['site_information']; ?>
                    </textarea>
            </div>
        </div>
        <script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="../../assets/js/popper/popper.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="../../assets/summernote/summernote-bs4.min.css" rel="stylesheet">
        <script src="../../assets/summernote/summernote-bs4.min.js"></script>
        <script>
            $('#summernote').summernote({
                placeholder: 'Site progress editor',
                tabsize: 2,
                height: 500
            });   
        </script>
    </div>
</div>
<?php
include('../../include/footer.php');
?>