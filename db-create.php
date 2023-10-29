<?php
$servername = "localhost";
$username = "root";
$password_db = "";

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password_db);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
	$sql = "CREATE DATABASE bank1";
   
    $conn->exec($sql);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>