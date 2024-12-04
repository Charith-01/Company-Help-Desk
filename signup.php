<?php
include_once 'header.php';

?>
<?php
require 'includes/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['c_password']);

    // Validate input
    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the email already exists
        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($emailCheckQuery);

        if ($result->num_rows > 0) {
            $error = 'Email is already registered.';
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
                $success = 'Registration successful! You can now <a href="login.php">log in</a>.';
            } else {
                $error = 'Database error: ' . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - IT Support Desk</title>
    <link rel="stylesheet" href="CSS/signup.css">
</head>
<body>
    

    <main>
        <!-- Signup Form Section -->
        <section class="signup-section">
            <div class="container">
                <h2>Create Your Account</h2>
                <p>Fill in the details below to register for the IT Support Desk.</p>

                <!-- Display error or success messages -->
                <?php if ($error): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
                <?php if ($success): ?>
                    <p style="color: green;"><?php echo $success; ?></p>
                <?php endif; ?>

                <form action="" method="POST" id="signup-form">
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="c_password" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" class="btn">Signup</button>
                </form>
                <div class="links">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
