<?php
// If the user is already logged in, redirect to the homepage
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dummy login credentials (replace this with a real database or API check)
    $valid_username = 'admin';
    $valid_password = 'password123';

    // Get user input
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Check if the username and password are correct
    if ($username === $valid_username && $password === $valid_password) {
        // Start a session and store the username
        $_SESSION['username'] = $username;
        header("Location: index.html");
        exit;
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="Images/logo.png" alt="Logo">
                <h1>IT Support Desk</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#knowledgebase">Knowledgebase</a></li>
                    <li><a href="#files">Files</a></li>
                    <li><a href="new_ticket.php" class="btn">Raise a Ticket</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Login Form Section -->
    <section class="form-section">
        <div class="container">
            <h2>Login to Your Account</h2>
            <p>Please enter your credentials to log in.</p>
            <form action="login.php" method="POST">
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 ApexCoders</p>
        </div>
    </footer>
</body>
</html>
