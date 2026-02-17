<?php
//Declare Connection Variables
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "university";

//Create Connection String
$connection = new mysqli($servername, $username, $password, $db_name);

//Check connection string
if ($connection->connect_error) {
    die ("Connection Error:" . $connection->connect_error);
}
?>