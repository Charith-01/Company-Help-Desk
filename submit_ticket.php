<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // Prepare SQL query
    $query = "INSERT INTO tickets (id, title, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("SQL preparation error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iss", $user_id, $title, $description);

    // Execute query
    if ($stmt->execute()) {
        echo "Ticket raised successfully!";
        header("Location: ticket_confirmation.php");
        exit();
    } else {
        echo "Execution error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
