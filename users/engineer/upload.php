<?php
// Include the database configuration file
include '../../include/connect.php';
$statusMsg = '';

// File upload path
$targetDir = "../../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
if (!empty($_FILES["file"]["name"])) {
    // var_dump($_FILES["file"]["name"]); die();
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $res = mysqli_query($db, "INSERT into image (`name`) VALUES ('$fileName')") or die(mysqli_error($db));
            if ($res) { ?>
                <script>
                    alert("File has been uploaded successfully.");
                    window.location = "site_design.php";
                </script>
            <?php
            } else { ?>
                <script>
                    alert("File upload failed, please try again.");
                    window.location = "site_design.php";
                </script>
            <?php
            }
        } else { ?>
            <script>
                alert("Sorry, there was an error uploading your file.");
                window.location = "site_design.php";
            </script>
        <?php
        }
    } else { ?>
        <script>
            alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
            window.location = "site_design.php";
        </script>
        <?php
    }
} else {?>
    <script>
        alert("Please select a file to upload.");
        window.location = "site_design.php";
    </script>
    <?php
}

// Display status message
echo $statusMsg;
?>