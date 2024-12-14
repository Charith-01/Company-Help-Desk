<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Check if user ID is provided
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Fetch user details
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('User not found.'); window.location.href = 'manage_users.php';</script>";
        exit();
    }

    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    echo "<script>alert('Invalid user ID.'); window.location.href = 'manage_users.php';</script>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $company_id = intval($_POST['company_id']);

    $update_query = "UPDATE users SET user_name = ?, email = ?, role = ?, company_id = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssii", $user_name, $email, $role, $company_id, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href = 'manage_users.php';</script>";
    } else {
        echo "<script>alert('Error updating user.'); window.location.href = 'manage_users.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="./CSS/manage_users.css">
</head>
<body>

<div class="edit-user-form-container">
    <h2>Edit User</h2>
    <form method="POST" class="edit-user-form">
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" id="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="Support" <?php echo ($user['role'] == 'Support') ? 'selected' : ''; ?>>Support</option>
            <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
        </select>

        <label for="company_id">Company ID:</label>
        <input type="number" name="company_id" id="company_id" value="<?php echo htmlspecialchars($user['company_id']); ?>" required>

        <button type="submit" class="btn save-btn">Save Changes</button>
        <a href="manage_users.php" class="btn cancel-btn">Cancel</a>
    </form>
</div>

</body>
</html>
