<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create a transactions table in the database
    $sql = "CREATE TABLE transactions (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            SenderID INT(6) NOT NULL,
            ReceiverID INT(6) NOT NULL,
            Amount FLOAT(10,2) NOT NULL,
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
    $conn->exec($sql);
    echo "Table 'transactions' created successfully";
}
catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
$conn = null;
?>
