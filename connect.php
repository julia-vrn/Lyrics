<?php
$connection = mysqli_connect('localhost', 'juliav', '12345', 'crud');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'crud');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

?>