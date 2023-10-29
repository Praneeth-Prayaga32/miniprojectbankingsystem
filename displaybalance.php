<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bank1";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select data from the database table
    $stmt = $conn->prepare("SELECT * FROM Accounts");
    $stmt->execute();

    // Display the data in a table
    echo "<table>";
    echo "<tr><th>ID</th><th>Balance</th></tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row["Accno"] . "</td>";
	  echo "<td>" . $row["Balance"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
