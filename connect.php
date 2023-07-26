<?php

$server = 'localhost';
$user = 'root';
$password = '';
$database = 'dbpus';

$db = mysqli_connect($server, $user, $password, $database);

if (!$db) {
  echo ("Connection failed: " . mysqli_connect_error());
}



?>