<?php

// get the transfer details from the form
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$amount = $_POST['amount'];
$password = $_POST['password'];

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

// check if sender has sufficient balance
$sql = "SELECT Balance, Password FROM Accounts WHERE Accno = $sender_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['Password'] != $password) {
    die("Incorrect password for sender's account");
}

if ($row['Balance'] < $amount) {
    die("Insufficient balance in sender's account");
}

// start transaction
mysqli_autocommit($conn, FALSE);

// update the sender's balance
$sql = "UPDATE Accounts SET Balance = Balance - $amount WHERE Accno = $sender_id";

if (mysqli_query($conn, $sql)) {
    echo "Sender's account updated successfully<br>";
} else {
    echo "Error updating sender's account: " . mysqli_error($conn) . "<br>";
    mysqli_rollback($conn);
}

// update the receiver's balance
$sql = "UPDATE Accounts SET Balance = Balance + $amount WHERE Accno = $receiver_id";

if (mysqli_query($conn, $sql)) {
    echo "Receiver's account updated successfully<br>";
} else {
    echo "Error updating receiver's account: " . mysqli_error($conn) . "<br>";
    mysqli_rollback($conn);
}

// insert the transaction details into the Transactions table
$sql = "INSERT INTO Transactions (SenderID, ReceiverID, Amount, Timestamp) VALUES ($sender_id, $receiver_id, $amount, NOW())";

if (mysqli_query($conn, $sql)) {
    echo "Transaction details added to the Transactions table successfully<br>";
    mysqli_commit($conn);
} else {
    echo "Error adding transaction details to the Transactions table: " . mysqli_error($conn) . "<br>";
    mysqli_rollback($conn);
}

mysqli_close($conn);

?>
