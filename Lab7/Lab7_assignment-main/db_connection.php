<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "university";

// create database connection
$connection = new mysqli($servername,$username,$password,$db_name);

// check connection 
if($connection->connect_error){
    die("Connection Error:" . $connection->connect_error);
}

?>