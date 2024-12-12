<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all ticket details
$query = "
    SELECT 
        t.ticket_id, t.ticket_title, t.ticket_description, t.ticket_status, t.created_at, 
        u.full_name AS submitted_by, 
        c.company_name AS current_company,
        tt.from_company_id, tt.to_company_id, tt.transferred_at 
    FROM tickets t
    LEFT JOIN users u ON t.user_id = u.id
    LEFT JOIN companies c ON t.company_id = c.company_id
    LEFT JOIN ticket_transfers tt ON t.ticket_id = tt.ticket_id
    ORDER BY t.created_at DESC
";

$result = $conn->query($query);
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./CSS/dashboard.css"> 
</head>
<body>

<div class="breadcrumb-container">
    <nav class="breadcrumb">
        <a href="../home.php" class="breadcrumb-logo">
            <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
        </a>
        <a href="../home.php" class="breadcrumb-link">Help Center</a>
        <span class="breadcrumb-separator">></span>
        <a href="#" class="breadcrumb-link active">Dashboard</a>
    </nav>
</div>

<div class="dashboard-container">
    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php" class="active">Tickets</a></li>
            <li><a href="manage_users.php">Users</a></li>
            <li><a href="manage_companies.php">Companies</a></li>
        </ul>
    </div>

    <!-- Main Content Section -->
    <main class="main-content">
        <h2>All Tickets Overview</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="ticket-table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Submitted By</th>
                        <th>Current Company</th>
                        <th>Transfer History</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($row['ticket_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['ticket_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['ticket_description']); ?></td>
                            <td>
                                <span class="ticket-status <?php echo strtolower($row['ticket_status']); ?>">
                                    <?php echo htmlspecialchars($row['ticket_status']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['submitted_by']); ?></td>
                            <td><?php echo htmlspecialchars($row['current_company']); ?></td>
                            <td>
                                <?php if ($row['from_company_id'] && $row['to_company_id']): ?>
                                    From: <?php echo htmlspecialchars($row['from_company_id']); ?><br>
                                    To: <?php echo htmlspecialchars($row['to_company_id']); ?><br>
                                    At: <?php echo htmlspecialchars($row['transferred_at']); ?>
                                <?php else: ?>
                                    Not Transferred
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tickets found.</p>
        <?php endif; ?>
    </main>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php
$conn->close();
?>
