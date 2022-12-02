<?php
include "../../include/connect.php";
include "../../base.php";
require 'process.php';
if (isset($_SESSION['message'])):
?>
<?php endif ?>
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/DataTableV2WithButtons/jquery.dataTables.css">
<div class="container my-2">
    <div class="row">
        <div class="col-md-4">
            <h4 class="text-center text-17">Add Expense</h4>
            <hr><br>
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label for="budgetTitle text-13">Budget Title</label>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="budget" class="form-control text-13" id="budgetTitle"
                        placeholder="Enter Budget Title" required autocomplete="off" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label for="amount text-13">Amount</label>
                    <input type="text" name="amount" class="form-control text-13" id="amount" placeholder="Enter Amount"
                        required value="<?php echo $amount; ?>">
                </div>
                <?php if ($update == true): ?>
                <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                <?php else: ?>
                <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-md-8">
            <strong>
                <h4 class="text-center text-16">Total Expenses : RWF
                    <?php echo number_format($total, 2, '.', ','); ?>
                </h4>
            </strong>
            <hr>
            <br><br>
            <h5 class="text-17">Expenses List</h5>
            <?php
            $result = mysqli_query($db, "SELECT * FROM budget");
            ?>
            <div class="row justify-content-center">
                <div class="table-responsive m-3">
                    <table style="font-size:14px !important;" class="table table-striped table-hover w-100" id="budget"
                        border="1">
                        <thead>
                            <tr>
                                <th>Budget Name</th>
                                <th>Budget Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                                <td>
                                    <?php echo 'RWF '. number_format($row['amount'], 2, '.', ','); ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="budget_process.php?edit=<?php echo $row['id']; ?>"
                                            class="btn btn-success btn-sm mr-4">Update</a>
                                        <a onclick="return confirm('Are you sure to delete this budget ?')"
                                            href="process.php?delete=<?php echo $row['id']; ?>"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../../scripts.php");
?>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../../assets/DataTableV2WithButtons/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/DataTableV2WithButtons/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $(' #budget').DataTable({
            language: {
                paginate: {
                    previous: '<i class="bx bx-chevron-left"></i>'
                    , next: '<i class="bx bx-chevron-right"></i>',
                },
                searchPlaceholder: "Search an expense ...", emptyTable: "No expenses available.",
            },
        });
    }); </script>