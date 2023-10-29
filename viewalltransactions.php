<?php

// connect to the database
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

$conn = mysqli_connect($servername, $username, $password_db, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// select all rows from the Transactions table
$sql = "SELECT * FROM Transactions";
$result = mysqli_query($conn, $sql);

// check if there are any rows in the table
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Sender ID: " . $row["SenderID"] . " - Receiver ID: " . $row["ReceiverID"] . " - Amount Transferred: " . $row["Amount"] . "<br>";# " - Timestamp: " . $row["Timestamp"] . "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
