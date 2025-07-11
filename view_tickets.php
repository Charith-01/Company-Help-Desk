<?php
include_once 'log_header.php';

include('includes/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch tickets for the logged-in user
$query = "SELECT ticket_id, ticket_title, ticket_description, created_at FROM tickets WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error preparing SQL: " . $conn->error);
}

// Bind parameters for user_id
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
    <link rel="stylesheet" href="CSS/view_tickets.css">
    <script src="JS/view_tickets.js" defer></script>
</head>
<body>

    <div class="breadcrumb-container">
        <nav class="breadcrumb">
            <a href="./home.php" class="breadcrumb-logo">
                <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
            </a>
            <a href="./home.php" class="breadcrumb-link">Help Center</a>
            <span class="breadcrumb-separator">></span>
            <a href="#" class="breadcrumb-link active">My Tickets</a>
        </nav>
    </div>
    
    <div class="container1">
        <div class="new">
            <h1>My Tickets</h1>
            <a href="new_ticket.php" class="btn primary">Raise a New Ticket</a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="ticket-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
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

    <?php include_once 'footer.php'; ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
