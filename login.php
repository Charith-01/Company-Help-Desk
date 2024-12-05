<?php
include_once 'header.php';
require 'includes/config.php'; // Include your database configuration file

// Initialize variables for error and success messages
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input fields
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } else {
        // Query to fetch the user with the given email using prepared statements
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email']; // Store email if needed for profile
                header("Location: profile.php"); // Redirect to the profile page
                exit;
            } else {
                $error = 'Incorrect password.';
            }
        } else {
            $error = 'No account found with this email.';
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    <!-- Login Form Section -->
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="POST">
                    <h2>Login hhhhhhhhhhhhhhhhh</h2>
                    
                    <!-- Display error or success messages -->
                    <?php if (!empty($error)): ?>
                        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($success)): ?>
                        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
                    <?php endif; ?>
                    
                    <div class="inputbox">
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                    <button type="submit">Log in</button>
                    <div class="register">
                        <p>Don't have an account? <a href="signup.php">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include_once 'footer.php'; ?>
</body>
</html>