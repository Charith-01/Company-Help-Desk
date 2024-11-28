<?php
require 'includes/config.php'; // Include your database configuration file

// Initialize variables for error and success messages
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validate input fields
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } else {
        // Query to fetch the user with the given email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                $success = 'Login successful!';
                exit();
            } else {
                $error = 'Incorrect password.';
            }
        } else {
            $error = 'No account found with this email.';
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IT Support Desk</title>
    <link rel="stylesheet" href="CSS/login.css">
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
                    <li><a href="#contact" class="btn">Contact Support</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Login Form Section -->
    <section class="login-section">
        <div class="container">
            <h2>Login to IT Support Desk</h2>
            <p>Enter your credentials to access the support system.</p>

            <!-- Display error or success messages -->
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <form action="" method="POST" id="login-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="links">
                <a href="forgot_password.html">Forgot Password?</a>
                <p>Don't have an account? <a href="signup.php">Register here</a></p>
            </div>
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
