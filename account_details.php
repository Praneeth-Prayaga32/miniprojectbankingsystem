<?php

// get the account details from the form
$email = $_POST['email'];
$accno = $_POST['accno'];

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

// check if the account exists and belongs to the user
$sql = "SELECT * FROM Accounts WHERE Accno = $accno AND Email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Invalid account details");
}

// display the account details
$row = mysqli_fetch_assoc($result);
echo "<h2>Account Details</h2>";
echo "ID: " . $row['Accno'] . "<br>";
echo "Balance: " . $row['Balance'] . "<br>";

// display the transactions involving the account
$sql = "SELECT * FROM Transactions WHERE SenderID = $accno OR ReceiverID = $accno";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<p>No transactions found</p>";
} else {
    echo "<h2>Transactions</h2>";
    echo "<table>";
    echo "<tr><th>Sender ID</th><th>Receiver ID</th><th>Amount</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['SenderID'] . "</td>";
        echo "<td>" . $row['ReceiverID'] . "</td>";
        echo "<td>" . $row['Amount'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

mysqli_close($conn);
?>
