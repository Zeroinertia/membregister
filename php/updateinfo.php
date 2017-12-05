<?php
require_once('connection.php');
session_start();
?>

<?php
  $id = $_SESSION['superid'];
  $newLName = $_GET['newlname'];
  $newFName = $_GET['newfname'];
  $newEMail = $_GET['newemail'];
  $newAddress = $_GET['newaddress'];
  $newPhone = $_GET['newphone'];
  $activity = $_GET['active'];

  if ($activity == "false")
    $activity = 0;
  else
    $activity = 1;

  $newLName = mysqli_real_escape_string($connection, $newLName);
  $newFName = mysqli_real_escape_string($connection, $newFName);
  $newEMail = mysqli_real_escape_string($connection, $newEMail);
  $newAddress = mysqli_real_escape_string($connection, $newAddress);
  $newPhone = mysqli_real_escape_string($connection, $newPhone);

  $query = "CALL updateEditDefaults('$id', '$newLName', '$newFName', '$newEMail', '$newAddress', '$newPhone', '$activity')";
  $sql = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error($connection));

  $SUPERID = 0;
  header("location: index.php");
  exit();
?>
