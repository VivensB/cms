<html>

<head>
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="./js/adapter.min.js"></script>
  <script src="./js/vue.min.js"></script>
  <script src="./js/instascan.min.js"></script>
</head>
<div class="col-md-6">
  <form method="post" action="qr_insert1.php" class="form-horizontal">
    <label>SCAN QR CODE</label>
    <input type="text" name="text" id="text" readonly="" placeholder="scan qr code" class="form-control">
  </form>
  <video id="preview"></video>
</div>
<script>
  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
  Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      console.error('No cameras found.');
    }
  }).catch(function (e) {
    console.error(e);
  });

  scanner.addListener('scan', function (c) {
    document.getElementById('text').value = c;
    document.forms[0].submit();
  });
</script>
</body>

</html>
<?php ?>