<?php
include_once '../includes/config.php';
session_start();

// Check if the support team member is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Support') {
    header("Location: ../login.php");
    exit();
}

// Check if ticket_id is provided
if (isset($_GET['ticket_id'])) {
    $ticket_id = intval($_GET['ticket_id']);

    // Update the ticket status to 'resolved'
    $query = "UPDATE tickets SET ticket_status = 'resolved', updated_at = NOW() WHERE ticket_id = ? AND company_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $ticket_id, $_SESSION['company_id']);

    if ($stmt->execute()) {
        header("Location: support_dashboard.php?success=Ticket+resolved+successfully");
    } else {
        header("Location: support_dashboard.php?error=Failed+to+resolve+ticket");
    }

    $stmt->close();
} else {
    header("Location: support_dashboard.php?error=Invalid+ticket+ID");
}

$conn->close();
?>
