<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DROP table Accounts";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>