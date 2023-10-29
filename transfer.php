// get the transfer details from the form
$sender_id = $_POST['sender_id'];
$sender_password = $_POST['sender_password'];
$receiver_id = $_POST['receiver_id'];
$amount = $_POST['amount'];

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

// check if sender's password is correct
$sql = "SELECT Password FROM Accounts WHERE Accno = $sender_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['Password'] != $sender_password) {
    die("Incorrect password for sender's account");
}

// check if sender has sufficient balance
$sql = "SELECT Balance FROM Accounts WHERE Accno = $sender_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['Balance'] < $amount) {
    die("Insufficient balance in sender's account");
}

// update the sender's balance
$sql = "UPDATE Accounts SET Balance = Balance - $amount WHERE Accno = $sender_id";

if (mysqli_query($conn, $sql)) {
    echo "Sender's account updated successfully<br>";
} else {
    echo "Error updating sender's account: " . mysqli_error($conn) . "<br>";
}

// update the receiver's balance
$sql = "UPDATE Accounts SET Balance = Balance + $amount WHERE Accno = $receiver_id";

if (mysqli_query($conn, $sql)) {
    echo "Receiver's account updated successfully<br>";
} else {
    echo "Error updating receiver's account: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
