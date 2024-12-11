<?php
session_start();
include_once 'logHeader.php';

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Help Desk Dashboard</title>
    <link rel="stylesheet" href="./CSS/d.css"> 
</head>
<body>

<div class="breadcrumb-container">
    <nav class="breadcrumb">
        <a href="./home.php" class="breadcrumb-logo">
            <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
        </a>
        <a href="./home.php" class="breadcrumb-link active">Help Center</a>
    </nav>
</div>

<main>
    <div class="container">
        <div class="dashboard-sidebar">
            <div class="sidebar-section">
                <h2>Tickets</h2>
                <ul>
                    <li><a href="#">All Tickets (235)</a></li>
                    <li><a href="#">Recent Tickets</a></li>
                    <li><a href="#">Open Tickets</a></li>
                </ul>
            </div>
            <div class="sidebar-section">
                <h2>Ticket Views</h2>
                <ul>
                    <li><a href="#">All Cases from Teams</a></li>
                    <li><a href="#">Support Cases</a></li>
                </ul>
            </div>
            <div class="sidebar-section">
                <h2>Settings</h2>
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="dashboard-main">
            <h2>Dashboard Overview</h2>

            <!-- Example Ticket Cards -->
            <div class="ticket-card">
                <h2>Ticket #12345</h2>
                <p>Issue: Unable to connect to VPN</p>
                <p>Assigned to: John Doe</p>
                <span class="ticket-status open">Open</span>
            </div>

            <div class="ticket-card">
                <h2>Ticket #12346</h2>
                <p>Issue: Printer not working</p>
                <p>Assigned to: Jane Smith</p>
                <span class="ticket-status closed">Closed</span>
            </div>

            <h2>Recent Tickets</h2>
            <table class="ticket-table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#12347</td>
                        <td>Software installation issue</td>
                        <td><span class="ticket-status open">Open</span></td>
                        <td>Mike Johnson</td>
                    </tr>
                    <tr>
                        <td>#12348</td>
                        <td>Network connectivity problem</td>
                        <td><span class="ticket-status closed">Closed</span></td>
                        <td>Emily Davis</td>
                    </tr>
                    <tr>
                        <td>#12349</td>
                        <td>Hardware malfunction</td>
                        <td><span class="ticket-status open">Open</span></td>
                        <td>Chris Brown</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once 'footer.php'; ?>

</body>
</html>
