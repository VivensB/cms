<?php
include('../../include/connect.php');
include('../../include/header.php');
include('./includes/sidebar.php');
include('../../base.php');

?>
<style>
        .uploadOuter {
                text-align: center;
                padding: 20px;
        }

        strong {
                padding: 0 10px
        }

        .dragBox {
                width: 550px;
                min-height: 300px;
                height: auto !important;
                margin: 0 auto;
                position: relative;
                text-align: center;
                font-weight: bold;
                line-height: 95px;
                color: #999;
                border: 2px dashed #ccc;
                display: inline-block;
                transition: transform 0.3s;
                padding-bottom: 20px;
        }

        input[type="file"] {
                position: absolute;
                height: 100%;
                width: 100%;
                opacity: 0;
                top: 0;
                left: 0;
        }

        .draging {
                transform: scale(1.1);
        }

        #preview {
                text-align: center;
        }

        img {
                max-width: 90%
        }

        .off {
                display: none;
        }

        .on {
                display: block;
        }

        .img-empty {
                width: 35%;
                margin-top: 7%;
        }
        .img-design {
                width: 75%;
                margin-top: 4%;
                border-radius: 5px;
                border: 2px solid #999;
                margin-bottom: 10px;
        }

        .error {
                border: 1px solid red;
                border-radius: 5px;
                padding: 13px;
                color: red;
                background: #FEDADA;
                font-weight: bold;
                margin-top: 15px;
        }
</style>
<div id="content-wrapper">
        <div class="container-fluid">
                <div class="row">
                        <div class="col col-10">
                                <h2>Construction Design format</h2>
                        </div>
                        <div class="col">
                                <a href="#" id="updateImg" class="btn btn-danger">Update Image</a>
                        </div>
                </div>
                <div id="upload" class="off">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="uploadOuter">
                                        <span class="dragBox">
                                                Darg and Drop image here
                                                <div id="preview"></div>
                                                <input type="file" name="file" onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                        </span>
                                </div>

                                <div class="row justify-content-center" style="padding-bottom: 20px;">
                                        <input type="submit" value="Save" class="btn btn-md btn-primary">
                                </div>
                        </form>

                </div>
                <?php

                $result = mysqli_query($db, "SELECT * FROM `image` ORDER BY created_at DESC LIMIT 1") or die(mysqli_error($db));
                $row = mysqli_fetch_assoc($result);
                if ($row) { ?>
                        <center>
                                <img class="img-design" src="<?= '../../uploads/' . $row['name'] ?>" alt="">
                        </center>

                <?php } else { ?>
                        <center>
                                <img class="img-empty" src="../../uploads/empty.png" alt="">
                                <br>
                                <span class="error">No Image Found</span>
                        </center>
                <?php } ?>
        </div>
</div>
<script>
        "use strict";

        const addImage = document.getElementById('updateImg');
        const container = document.getElementById('upload');

        function dragNdrop(event) {
                var fileName = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                var previewImg = document.createElement("img");
                previewImg.setAttribute("src", fileName);
                preview.innerHTML = "";
                preview.appendChild(previewImg);
        }

        function drag() {
                document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
                document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }
        addImage.addEventListener('click', () => {
                container.classList.remove("off");
                container.classList.add("on");
        });
</script>
<?php

include('../../scripts.php');
include('../../include/footer.php');

?>