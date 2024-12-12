<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Fetch all companies from the database
$query = "SELECT company_id, company_name, company_type, date_created FROM companies ORDER BY date_created DESC";
$result = $conn->query($query);

// Check for SQL errors
if (!$result) {
    die("SQL Error: " . $conn->error);
}

// Handle Add Company request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_company'])) {
    $company_name = $_POST['company_name'];
    $company_type = $_POST['company_type'];

    $insert_query = "INSERT INTO companies (company_name, company_type, date_created) VALUES ('$company_name', '$company_type', NOW())";
    if ($conn->query($insert_query)) {
        header("Location: manage_companies.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

// Dynamically add the 'active' class to the Companies button
$active_companies = "active";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Companies</title>
    <link rel="stylesheet" href="./CSS/manage_companies.css">
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
            <li><a href="dashboard.php">Tickets</a></li>
            <li><a href="manage_users.php">Users</a></li>
            <li><a href="manage_companies.php" class="<?php echo $active_companies; ?>">Companies</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2>Manage Companies</h2>

        <!-- Add New Company Form -->
        <form method="POST" action="" class="add-company-form">
            <h3>Add New Company</h3>
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" required>

            <label for="company_type">Company Type</label>
            <input type="text" id="company_type" name="company_type" required>

            <button type="submit" name="add_company" class="btn add-btn">Add Company</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <div class="table-wrapper">
                <table class="companies-table">
                    <thead>
                        <tr>
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Company Type</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>#<?php echo htmlspecialchars($row['company_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['company_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_created']); ?></td>
                                <td>
                                    <a href="edit_company.php?id=<?php echo $row['company_id']; ?>" class="btn edit-btn">Edit</a>
                                    <a href="delete_company.php?id=<?php echo $row['company_id']; ?>" class="btn delete-btn" 
                                       onclick="return confirm('Are you sure you want to delete this company?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No companies found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>
