<?php 

session_start();

$mysqli = new mysqli('localhost', 'juliav', '12345', 'crud') or die(mysqli_error($mysqli));
mysqli_query($mysqli,"SET NAMES UTF8");

$result = $mysqli->query("SELECT * FROM lyrics") or die(mysqli_error($mysqli));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  
</body>
</html>