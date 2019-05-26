<?php 
session_start();
$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");


if(isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM lyrics WHERE id=$id") or die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";
  header("location: editbase.php?c=1");
}

?>