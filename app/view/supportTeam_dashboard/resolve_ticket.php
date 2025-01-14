<?php
include_once '../../model/includes/config.php';
require_once '../../model/TicketModel.php'; // Ensure the path is correct

session_start();

// Ensure the user is logged in and has the correct access type
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Support') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['ticket_id'])) {
    $ticket_id = intval($_GET['ticket_id']);

    // Initialize TicketModel with the database connection
    $ticketModel = new TicketModel($conn); // Pass $conn to the model constructor
    $result = $ticketModel->resolveTicket($ticket_id, $_SESSION['company_id']);

    if ($result) {
        header("Location: support_dashboard.php?success=Ticket+resolved+successfully");
    } else {
        header("Location: support_dashboard.php?error=Failed+to+resolve+ticket");
    }
} else {
    header("Location: support_dashboard.php?error=Invalid+ticket+ID");
}
?>
