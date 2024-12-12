<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Help Desk</title>
    <link rel="stylesheet" href="CSS/logheader.css">
    <script src="JS/logheader.js"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="./home.php"><img src="Images/logo.png" alt="Logo"></a>
                <h1><a href="./home.php">Hellodesk.</a></h1>    
            </div>
            <!-- <nav>
                <ul class="nav-links">
                    <li><a href="home.php" class="btn">Home</a></li>
                    <li><a href="home.php" class="btn">Knowledgebase</a></li>
                    <li><a href="home.php" class="btn">Raise a Ticket</a></li>
                    <li><a href="home.php" class="btn">Contact Support</a></li>
                </ul>
            </nav> -->
            
            <!-- My Tickets and Logout buttons -->
            <div class="login-container">
                <a href="view_tickets.php" class="btn secondary">My Tickets</a>
                <a href="profile.php" class="btn profile"><?php echo ($_SESSION['full_name']); ?></a>
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </div>
    </header>
</body>
</html>