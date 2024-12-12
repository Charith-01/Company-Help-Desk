<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Check if the company ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $company_id = $_GET['id'];

    // Prepare the SQL query to delete the company from the database
    $delete_query = "DELETE FROM companies WHERE company_id = ?";

    // Initialize the prepared statement
    if ($stmt = $conn->prepare($delete_query)) {
        // Bind the company ID to the statement
        $stmt->bind_param("i", $company_id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to the manage companies page after successful deletion
            header("Location: manage_companies.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid company ID.";
}

$conn->close();
?>
