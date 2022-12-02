<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
if(isset($_GET['report'])){
    $reportId = $_GET['report'];
    $select = "SELECT * FROM site_progress WHERE id='$reportId'";
    $query = mysqli_query($db, $select);
    $result = mysqli_fetch_array($query);
}
?>
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">
    <div class="container-fluid">
        <h4>Site Progress</h4>
        <hr>
        <div class="container my-5">
            <form method="post">
                <div class="form-group">
                    <label for=""><?php echo $result['report_title']; ?></label>
                    <textarea id="summernote" required class="form-control" name="siteProgress">
                        <?php echo $result['site_information']; ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="SubmitChanges" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <script src="../../assets/js/jquery/jquery-3.5.1.min.js"></script>
        <script src="../../assets/js/popper/popper.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <link href="../../assets/summernote/summernote-bs4.min.css" rel="stylesheet">
        <script src="../../assets/summernote/summernote-bs4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
        <script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $(' #siteProgressReports').DataTable({
                    language: {
                        paginate: {
                            previous: '<i class="bx bx-chevron-left"></i>'
                            , next: '<i class="bx bx-chevron-right"></i>',
                        },
                        searchPlaceholder: "Search a report ...", 
                        emptyTable: "No report available.",
                    },
                });
            }); 
        </script>
        <script>
            $('#summernote').summernote({
                placeholder: 'Site progress editor',
                tabsize: 2,
                height: 350
            });   
        </script>
    </div>
</div>
<?php
if (isset($_POST["SubmitChanges"])) {
    $siteContent = $_POST["siteProgress"];
    if (empty($siteContent)) {
        echo '<script>alert("Please write the site progress content.")</script>';
    } else {
        $update = "UPDATE site_progress SET site_information='$siteContent' WHERE id='$reportId'";
        $query = mysqli_query($db, $update);
        if ($query) {
            echo '
                <script>
                    alert("Site information is updated successfully.");
                    window.location.href="site_progress.php";
                </script>
            ';
        }
    }
}
include('../../include/footer.php');
?>