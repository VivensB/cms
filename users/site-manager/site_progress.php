<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
require('../../base.php');
?>
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/custom-styles.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div id="content-wrapper">
  <div class="container-fluid">
    <h4>Site Progress</h4>
    <hr>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
      Add Site Data
    </button>

    <div class="container my-5">
      <div class="card">
        <div class="card-header">
          Site Progress Reports
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="table-responsive">
                <table id="siteProgressReports" class="table">
                  <thead>
                    <tr>
                      <th>Report Title</th>
                      <th>Reported Date Time</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                  $query = "SELECT * FROM site_progress";
                  $result = mysqli_query($db, $query) or die(mysqli_error($db));
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['report_title'] . '</td>';
                    echo '<td>' . date("d/m/Y h:i:s", strtotime($row['added'])) . '</td>';
                  ?>
                    <td>
                      <div class="d-flex justify-content-start">
              
                        <a type="link" href="view-site-progress-data.php?report=<?php echo $row['id']; ?>"
                          class="btn btn-info text-white mx-4 btn-sm"> <i class="fas fa-eye"></i> View</a>
                        
                      </div>
                    </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <form method="post">
            <div class="modal-header">
              <h5 class="modal-title">Add Site Progress Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="my-input">Report Title</label>
                <input id="my-input" placeholder="Report title" class="form-control" required type="text"
                  name="reportTitle">
              </div>
              <div class="form-group">
                <label for="">Site progress writter</label>
                <textarea id="summernote" required class="form-control" name="siteProgress"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" name="submitSiteData" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
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
            searchPlaceholder: "Search a report ...", emptyTable: "No report available.",
          },
        });
      }); </script>
    <script>
      $('#summernote').summernote({
        placeholder: 'Write all content includes *images.*videos,*texts,*tables,... ',
        tabsize: 2,
        height: 300
      });
      $('#summernote1').summernote({
        placeholder: 'Site progress reports editor',
        tabsize: 2,
        height: 300
      });
    </script>
  </div>
  <?php
  if (isset($_POST["submitSiteData"])) {
    $title = $_POST["reportTitle"];
    $siteContent = $_POST["siteProgress"];
    if (empty($title)) {
      echo '<script>alert("Please enter report title.")</script>';
    } else
      if (empty($siteContent)) {
        echo '<script>alert("Please write the site progress content.")</script>';
      } else {
        $insert = "INSERT INTO site_progress(report_title,site_information) VALUES('$title','$siteContent')";
        $query = mysqli_query($db, $insert);
        if ($query) {
          echo '<script>alert("Site information is added successfully.")</script>';
        }
      }
  }
  include('../../include/footer.php');
  ?>