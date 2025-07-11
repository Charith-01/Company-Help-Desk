<?php
include_once 'header.php';
require 'includes/config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['c_password']);
    $role = $conn->real_escape_string($_POST["role"]);
    $company_id = $conn->real_escape_string($_POST["company_id"]);

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
        $emailCheckQuery = "SELECT * FROM users WHERE email = ?";
        if ($stmt = $conn->prepare($emailCheckQuery)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $error = 'Email is already registered.';
            } else {
                // Insert the user into the database
                $insertQuery = "INSERT INTO users (full_name, email, password, role, company_id) VALUES (?, ?, ?, ?, ?)";
                if ($stmt = $conn->prepare($insertQuery)) {
                    $stmt->bind_param("ssssi", $fullName, $email, $hashedPassword, $role, $company_id);
                    if ($stmt->execute()) {
                        $success = 'Registration successful!';
                    } else {
                        $error = 'Registration failed. Please try again. ' . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = 'Error preparing query. Please try again.';
                }
            }
        } else {
            $error = 'Error preparing query. Please try again.';
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
    <section>
        <div class="form-box">
            <h2>Create Your Account</h2>

            <!-- Display error or success messages -->
            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>

            <form action="" method="POST" id="signup-form">
                <div class="inputbox">
                    <input type="text" id="full-name" name="full_name" required>
                    <label for="full-name">Full Name</label>
                </div>
                <div class="inputbox">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email Address</label>
                </div>
                <div class="inputbox">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="inputbox">
                    <input type="password" id="confirm-password" name="c_password" required>
                    <label for="confirm-password">Confirm Password</label>
                </div>

                <div class="inputbox">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <option value="support">Support Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>  
                
                <div class="inputbox">
                    <label for="company_id">Company:</label>
                    <select name="company_id" id="company_id" required>
                        <option value="1">Sub-Company 1</option>
                        <option value="2">Sub-Company 2</option>
                        <option value="3">Sub-Company 3</option>
                        <option value="4">Sub-Company 4</option>
                        <option value="5">Sub-Company 5</option>
                        <option value="6">Primary Company</option>
                    </select>
                </div>     



                <button type="submit">Signup</button>
            </form>
            <div class="login">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    include_once 'footer.php';
    ?>
</body>
</html>
