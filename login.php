<?php
include_once 'header.php';

?>

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
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email']; // Store email if needed for profile
                header("Location: profile.php"); // Redirect to the profile page
                exit;
            }
            else {
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
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
    
    <!-- Login Form Section -->
<section>
    <div class="form-box">
        <div class="form-value">
            <form action="">
                <h2>Login</h2>
                <div class="inputbox">
                    <input type="email" required>
                    <label for="">Email</label>
                </div>
                <div class="inputbox">
                    <input type="password" required>
                    <label for="">Password</label>
                </div>
                <div class="forget">
                <label><a href="#">Forgot password?</a></label>
                </div>
                <button>Log in</button>
                <div class="register">
                <p>Don't have a account ? <a href="signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

    <?php
             include_once 'footer.php';

    ?>   
</body>
</html>
