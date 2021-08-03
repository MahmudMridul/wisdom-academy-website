<?php

$servername = "localhost";
$user = "root";
$password = "";
$database = "wisdom_academy";

$connection = mysqli_connect($servername, $user, $password, $database);

if(!$connection)
{
  die("Connection Failed: " . mysqli_connect_error());
}


//mysqli_close($connection);
?>
