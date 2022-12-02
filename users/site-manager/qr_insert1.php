<?php
include('../../include/connect.php');
date_default_timezone_set('Africa/Kigali');
if (isset($_POST['text'])) {
  $voice = new com("SAPI.SpVoice");
  $text = $_POST['text'];
  $result = explode('-', $text);
  $emp_ref = $result[0];
  $empName = $result[1]; 
  $date = date('Y-m-d');
  $time = date('H:i:s');
  $message = "Hi" . $text . "Your Attendence has been successfully added Thank you";
  $timeout = "Hi" . $text . "Your Attendence has been successfully added Good bye";

  $sql = "SELECT * FROM attendance WHERE ((((emp_id='$emp_ref') AND (name='$empName') AND (logdate='$date') AND (scan_num=1))))";
  $query = mysqli_query($db, $sql);
  $res = mysqli_num_rows($query);
  /* Check attendance 2 */
  $sql1 = "SELECT * FROM attendance WHERE ((((emp_id='$emp_ref') AND (name='$empName') AND (logdate='$date') AND (scan_num=2))))";
  $query1 = mysqli_query($db, $sql1);
  $res1 = mysqli_num_rows($query1);
  /* Check attenance 3 */
  $sql2 = "SELECT * FROM attendance WHERE ((((emp_id='$emp_ref') AND (name='$empName') AND (logdate='$date') AND (scan_num=3))))";
  $query2 = mysqli_query($db, $sql2);
  $res2 = mysqli_num_rows($query2);
  // Validate attendance number
  $sqlValidate = "SELECT * FROM attendance WHERE (((((emp_id='$emp_ref') AND (name='$empName') AND (logdate='$date') AND (status=1) AND(scan_num=4)))))";
  $queryValidate = mysqli_query($db, $sqlValidate);
  $resValidate = mysqli_num_rows($queryValidate);
  if ($resValidate > 0) {
    $voice->speak("Sorry attendance times to this employee ' . $empName . ' with employee code ' . $emp_ref . ' is over today.");
    echo '<script>
            alert("Sorry attendance times to this employee ' . $empName . ' with employee code ' . $emp_ref . ' is over today.");
            window.location.href="attendence.php";
          </script>';
  } else {
    /* ====================================================*/
    if ($res > 0) {
      $queryUpdateAttendance = mysqli_query($db, "UPDATE attendance SET Timeout='$time',scan_num=2 WHERE ((emp_id='$emp_ref') AND (logdate='$date'))");
      if ($queryUpdateAttendance) {
        $voice->speak($timeout);
        header("location:attendence.php");
      }
    } else if ($res1 > 0) {
      $queryUpdateAttendance1 = mysqli_query($db, "UPDATE attendance SET Timein_PM='$time',scan_num=3 WHERE ((emp_id='$emp_ref') AND (logdate='$date'))");
      if ($queryUpdateAttendance1) {
        $voice->speak($timeout);
        header("location:attendence.php");
      }
    } else if ($res2 > 0) {
      $queryUpdateAttendance2 = mysqli_query($db, "UPDATE attendance SET Timeout_PM='$time',scan_num=4, status=1 WHERE ((emp_id='$emp_ref') AND (logdate='$date'))");
      if ($queryUpdateAttendance2) {
        $voice->speak($timeout);
        header("location:attendence.php");
      }
    } else {
      $queryInsertAttendance = mysqli_query($db, "INSERT INTO attendance(logdate,emp_id,name,Timein,Timeout,Timein_PM,Timeout_PM,status,scan_num) 
            VALUES ('$date','$emp_ref','$empName','$time',null,null,null,0,1)");
      if ($queryInsertAttendance) {
        $voice->speak($message);
        header("location:attendence.php");
      } else {
        echo "not";
      }
    }
  }
}

?>