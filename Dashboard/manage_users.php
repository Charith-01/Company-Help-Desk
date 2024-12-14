<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all users from the database
$query = "SELECT id, user_name, email, role, company_id, date_created FROM users ORDER BY date_created DESC";
$result = $conn->query($query);

// Check for SQL errors
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="./CSS/manage_users.css">
</head>
<body>

<div class="breadcrumb-container">
    <nav class="breadcrumb">
        <a href="#" class="breadcrumb-logo">
            <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
        </a>
        <a href="#" class="breadcrumb-link">Help Center</a>
        <span class="breadcrumb-separator">></span>
        <a href="#" class="breadcrumb-link active">Dashboard</a>
    </nav>
</div>

<div class="dashboard-container">
    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php">Tickets</a></li>
            <li><a href="manage_users.php" class="active">Users</a></li>
            <li><a href="manage_companies.php">Companies</a></li>
        </ul>
    </div>

    <main class="main-content">
        <h2>All Users</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Company ID</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['company_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_created']); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                                <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>

    <!-- Generate Report Button -->
    <form action="generate_report.php" method="POST">
        <input type="hidden" name="report_type" value="users">
        <button type="submit" class="generate-pdf-btn">Generate Report</button>
    </form>        
        

    </main>    
    
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>
