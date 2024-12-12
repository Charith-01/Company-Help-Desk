<?php
include_once '../includes/config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Support') {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['transfer_ticket'])) {
    $ticket_id = intval($_POST['ticket_id']);
    $to_company_id = intval($_POST['to_company_id']);
    $from_company_id = $_SESSION['company_id'];
    $transfer_status = 'Open'; // Reset to Open when transferred
    $transferred_at = date("Y-m-d H:i:s");

    // Update the ticket's company_id and status to Open
    $query = "UPDATE tickets SET company_id = ?, ticket_status = ? WHERE ticket_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("SQL Error (Update Tickets): " . $conn->error);
    }

    $stmt->bind_param("isi", $to_company_id, $transfer_status, $ticket_id);
    $stmt->execute();

    // Log the transfer in the ticket_transfers table
    $transfer_query = "INSERT INTO ticket_transfers 
        (ticket_id, from_company_id, to_company_id, transferred_at) 
        VALUES (?, ?, ?, ?)";
    $stmt_transfer = $conn->prepare($transfer_query);

    if (!$stmt_transfer) {
        die("SQL Error (Insert Transfer): " . $conn->error);
    }

    $stmt_transfer->bind_param("iiis", $ticket_id, $from_company_id, $to_company_id, $transferred_at);
    $stmt_transfer->execute();

    header("Location: support_dashboard.php?success=Ticket+transferred+successfully");
} else {
    header("Location: support_dashboard.php?error=Invalid+request");
}

$conn->close();
?>
