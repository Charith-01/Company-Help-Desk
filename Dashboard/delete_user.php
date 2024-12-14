<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Prevent deletion of admin accounts
    $check_query = "SELECT role FROM users WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    if ($role === 'Admin') {
        echo "<script>alert('Cannot delete an admin account!'); window.location.href = 'manage_users.php';</script>";
        exit();
    }

    // Delete the user from the database
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href = 'manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user.'); window.location.href = 'manage_users.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid user ID.'); window.location.href = 'manage_users.php';</script>";
}

$conn->close();
?>
