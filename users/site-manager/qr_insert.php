<?php
include('../../include/connect.php');
if (isset($_POST['text'])) {
  $voice = new com("SAPI.SpVoice");
  $text = $_POST['text'];
  $date = date('Y-m-d');
  $time = date('H:i:s');
  $message = "Hi" . $text . "Your Attendence has been successfully added Thank you";
  $timeout = "Hi" . $text . "Your Attendence has been successfully added Good bye";
  // ================= Query attendance 2 10:00 Am ===================
  $sql = "SELECT*FROM attendance WHERE name='$text' AND logdate='$date' AND status=1";
  $query = mysqli_query($db, $sql);
  $res = mysqli_num_rows($query);
  $row = mysqli_fetch_array($query);
  $incrementStatus = $row['status'] + 1;
  // ================= end of query ========================
  // ================= Query attendance 2 02:00 Pm ===================
  $sql1 = "SELECT*FROM attendance WHERE name='$text' AND logdate='$date' AND status=2";
  $query1 = mysqli_query($db, $sql1);
  $res1 = mysqli_num_rows($query1);
  $row1 = mysqli_fetch_array($query1);
  $incrementStatus1 = $row['status'] + 1;
  // ================= end of query ========================
  // ================= Query attendance 05:00 Pm ===================
  $sql2 = "SELECT*FROM attendance WHERE name='$text' AND logdate='$date' AND status=3";
  $query2 = mysqli_query($db, $sql2);
  $res2 = mysqli_num_rows($query2);
  $row2 = mysqli_fetch_array($query2);
  $incrementStatus2 = $row['status'] + 1;
  // ================= end of query ========================
  if ($row['status'] == 1) {
    $sqlNewCheckIn = mysqli_query($db, "INSERT INTO attendance(logdate,name,Timein,status) VALUES ('$date','$text','$time','$incrementStatus')");
    $sql = mysqli_query($db, "UPDATE attendance SET name='$text',Timeout='10:00:00' WHERE name='$text' AND logdate='$date'");
    $voice->speak($timeout);
    return null;
  } else if ($row1['status'] == 2) {
    $sqlNewCheckIn = mysqli_query($db, "INSERT INTO attendance(logdate,name,Timein,status) VALUES ('$date','$text','$time','$incrementStatus1')");
    $sql = mysqli_query($db, "UPDATE attendance SET name='$text',Timeout='12:00:00' WHERE name='$text' AND logdate='$date'");
    $voice->speak($timeout);
    return null;
  }else if ($row2['status'] == 3) {
    $sqlNewCheckIn = mysqli_query($db, "INSERT INTO attendance(logdate,name,Timein,status) VALUES ('$date','$text','$time','$incrementStatus2')");
    $sql = mysqli_query($db, "UPDATE attendance SET name='$text',Timeout='05:00:00' WHERE name='$text' AND logdate='$date'");
    $voice->speak($timeout);
    return null;
  } else {
    $checkTimeQuery = mysqli_query($db, "SELECT * from attendance WHERE logdate='$date' AND Timein ='$time' AND name='text'");
    $resultQuery = mysqli_fetch_array($checkTimeQuery);
    if (strtotime($resultQuery['Timein']) > "08:10:00") {
      echo '<script>alert("Sorry you are too late please continue to the next attendance.")</script>';
    } else {
      $sql = "INSERT INTO attendance(logdate,name,Timein,status) VALUES ('$date','$text','$time',1)";
      if ($res = mysqli_query($db, $sql) === TRUE) {
        $voice->speak($message);
      } else {
        echo "not";
      }
    }
  }
}
header("location:attendence.php");
?>