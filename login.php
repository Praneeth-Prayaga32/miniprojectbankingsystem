<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form submission
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Select data from the database table with matching email and password
        $stmt = $conn->prepare("SELECT * FROM Accounts WHERE email=:email AND password=:password");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        // If there is a matching account, redirect to the admin page
        if ($stmt->rowCount() == 1) {
            header("Location: home.html");
            exit();
        }
        else {
            // If there is no matching account, display an error message
            echo "Invalid email or password";
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>
