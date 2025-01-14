<?php
include_once '../common/log_header.php';
require '../../controller/TicketController.php';

// Assuming $conn is your database connection
$ticketModel = new TicketModel($conn); // Initialize TicketModel with the DB connection

$userId = $_SESSION['user_id'];
$tickets = $ticketModel->getTicketsByUserId($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
    <link rel="stylesheet" href="../../../assets/CSS/view_tickets.css">
</head>
<body>

    <div class="breadcrumb-container">
        <nav class="breadcrumb">
            <a href="../pages/home.php" class="breadcrumb-logo">
                <img src="../../../assets/Images/logo.png" alt="Help Desk Logo" class="logo">
            </a>
            <a href="../pages/home.php" class="breadcrumb-link">Help Center</a>
            <span class="breadcrumb-separator">></span>
            <a href="#" class="breadcrumb-link active">My Tickets</a>
        </nav>
    </div>

    <div class="container1">
        <div class="new">
            <h1>My Tickets</h1>
            <a href="new_ticket.php" class="btn primary">Raise a New Ticket</a>
        </div>

        <?php if ($tickets->num_rows > 0): ?>
            <div class="ticket-grid">
                <?php while ($row = $tickets->fetch_assoc()): ?>
                    <div class="ticket-card">
                        <div class="ticket-header">
                            <h3><?php echo htmlspecialchars($row['ticket_title']); ?></h3>
                        </div>
                        <div class="ticket-body">
                            <p><?php echo htmlspecialchars($row['ticket_description']); ?></p>
                            <p class="date">Submitted on: <?php echo htmlspecialchars($row['created_at']); ?></p>
                        </div>
                        <div class="ticket-footer">
                            <button class="btn view-more" onclick="showDetails(<?php echo htmlspecialchars($row['ticket_id']); ?>)">View More</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-tickets">No tickets found. Submit a new ticket!</p>
        <?php endif; ?>
    </div>

<?php include_once '../common/footer.php'; ?>
</body>
</html>
