<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Check if the user is logged in and has a support role
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Support') {
    header("Location: ../login.php");
    exit();
}

// Get the company_id of the logged-in support team member
$company_id = $_SESSION['company_id'];

// Fetch all tickets assigned to the support team’s company
$query = "SELECT ticket_id, ticket_title, ticket_description, ticket_status, created_at 
          FROM tickets 
          WHERE company_id = ? 
          ORDER BY created_at DESC";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing SQL: " . $conn->error);
}

// Bind the company_id parameter
$stmt->bind_param("i", $company_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Team Dashboard</title>
    <link rel="stylesheet" href="CSS/support_dashboard.css">
</head>
<body>

<div class="breadcrumb-container">
    <nav class="breadcrumb">
        <a href="#" class="breadcrumb-logo">
            <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
        </a>
        <a href="#" class="breadcrumb-link">Help Center</a>
        <span class="breadcrumb-separator">></span>
        <a href="#" class="breadcrumb-link active">Support Dashboard</a>
    </nav>
</div>

<div class="container">
    <h1>Support Dashboard</h1>

    <?php if ($result->num_rows > 0): ?>
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
                <?php while ($row = $result->fetch_assoc()): ?>
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
// Open transfer modal
function openTransferModal(ticketId) {
    document.getElementById("transferModal").style.display = "block";
    document.getElementById("ticket_id_input").value = ticketId;
}

// Close transfer modal
function closeTransferModal() {
    document.getElementById("transferModal").style.display = "none";
}
</script>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
