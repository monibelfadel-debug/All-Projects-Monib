<?php
//Declare Connection Variables
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "students";

//Create Connection String
$connection = new mysqli($servername, $username, $password, $db_name);

//Check connection string
if ($connection->connect_error) {
    echo "Database Connection Failed";
} else {
    echo "Database Connected Successfully";
}
?>