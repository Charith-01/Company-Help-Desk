<?php
include_once 'log_header.php';




// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Retrieve user details from session
$userName = $_SESSION['user_name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - IT Support Desk</title>
    <link rel="stylesheet" href="CSS/profile.css">
</head>
<body>

    <div class="breadcrumb-container">
        <nav class="breadcrumb">
            <a href="./home.php" class="breadcrumb-logo">
                <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
            </a>
            <a href="./home.php" class="breadcrumb-link">Help Center</a>
            <span class="breadcrumb-separator">></span>
            <a href="./profile.php" class="breadcrumb-link active">Profile</a>
        </nav>
    </div>
    
    <!-- Profile Section -->
    <section class="profile-section">
        <div class="profile-container">
            <div class="profile-header">
                <img src="Images/icon.png" alt="User Avatar" class="profile-avatar">
                <h2>Welcome, <?php echo htmlspecialchars($userName); ?>!</h2>
            </div>
            <div class="profile-details">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Account ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
                <a href="edit-profile.php" class="btn-edit-profile">Edit Profile</a>
            </div>
        </div>
    </section>

    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
