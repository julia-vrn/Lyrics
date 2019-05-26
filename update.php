<?php 
session_start();
$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");



if(isset($_POST['update'])){
  $id = $_POST['id'];
  $category = $_POST['category'];
  $keyphrase = $_POST['keyphrase'];
  $comment = $_POST['comment'];
  $song = $_POST['song'];
  $quote= $_POST['quote'];

  $mysqli->query("UPDATE lyrics SET category='$category', keyphrase='$keyphrase', comment='$comment', song='$song', quote='$quote' WHERE id='$id'") or die($mysqli->error);

  header("location: editbase.php");

}


?>