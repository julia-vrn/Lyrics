<?php 
session_start();
$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");



if(isset($_POST['update'])){
  $id = $_REQUEST['id'];
  $category = $_REQUEST['category'];
  $keyphrase = $_REQUEST['keyphrase'];
  $comment = $_REQUEST['comment'];
  $song = $_REQUEST['song'];
  $quote= $_REQUEST['quote'];

  $mysqli->query("UPDATE lyrics SET category='$category', keyphrase='$keyphrase', comment='$comment', song='$song', quote='$quote' WHERE id=$id") or die($mysqli->error);

  header("location: editbase.php");

}


?>