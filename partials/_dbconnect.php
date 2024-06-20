<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("You are not connected duu to this error--->". mysqli_connect_error($conn));
}



?>