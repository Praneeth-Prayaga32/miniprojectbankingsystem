<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into the database table
    $stmt = $conn->prepare("INSERT INTO Accounts (firstname, lastname, email, password,Balance) VALUES (:firstname, :lastname, :email, :password, :Balance)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':Balance', $Balance);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $Balance = $_POST['Balance'];
    $stmt->execute();
    echo "New record created successfully";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
