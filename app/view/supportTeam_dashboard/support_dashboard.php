<?php
include_once '../common/logHeader.php';

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Support') {
    header("Location: ../auth/login.php");
    exit();
}

// Initialize the controller with the database connection
require_once('../../controller/TicketController.php');
$ticketController = new TicketController($conn);

// Assuming the company ID is stored in the session
$company_id = $_SESSION['company_id']; // Ensure this value is set when the user logs in

// Fetch tickets for the dashboard
$tickets = $ticketController->showTicketsForCompany($company_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../assets/CSS/support_dashboard.css">
</head>
<body>

<div class="breadcrumb-container">
    <nav class="breadcrumb">
        <a href="#" class="breadcrumb-logo">
            <img src="../../../assets/Images/logo.png" alt="Help Desk Logo" class="logo">
        </a>
        <a href="#" class="breadcrumb-link">Help Center</a>
        <span class="breadcrumb-separator">></span>
        <a href="#" class="breadcrumb-link active">Support Dashboard</a>
    </nav>
</div>

<div class="container">
    <h1>Support Dashboard</h1>

    <?php if ($tickets->num_rows > 0): ?>
        <table class="ticket-table">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $tickets->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ticket_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['ticket_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['ticket_description']); ?></td>
                        <td>
                            <span class="status <?php echo strtolower($row['ticket_status']); ?>">
                                <?php echo htmlspecialchars($row['ticket_status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="resolve_ticket.php?ticket_id=<?php echo $row['ticket_id']; ?>" class="btn resolve">Resolve</a>
                            <button class="btn transfer" onclick="openTransferModal(<?php echo $row['ticket_id']; ?>)">Transfer</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-tickets">No tickets assigned yet.</p>
    <?php endif; ?>
</div>

<!-- Transfer Ticket Modal -->
<div id="transferModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeTransferModal()">&times;</span>
        <h2>Transfer Ticket</h2>
        <form action="transfer_ticket.php" method="POST">
            <input type="hidden" id="ticket_id_input" name="ticket_id">
            <label for="to_company_id">Select Company to Transfer:</label>
            <select name="to_company_id" required>
                <option value="">--Select Company--</option>
                <option value="1">Sub-Company 1</option>
                <option value="2">Sub-Company 2</option>
                <option value="3">Sub-Company 3</option>
                <option value="4">Sub-Company 4</option>
                <option value="5">Sub-Company 5</option>
                <option value="6">Primary Company</option>
            </select>
            <button type="submit" name="transfer_ticket">Transfer</button>
        </form>
    </div>
</div>

<script>
function openTransferModal(ticketId) {
    document.getElementById("transferModal").style.display = "block";
    document.getElementById("ticket_id_input").value = ticketId;
}

function closeTransferModal() {
    document.getElementById("transferModal").style.display = "none";
}
</script>

<?php include_once '../common/footer.php'; ?>

</body>
</html>
