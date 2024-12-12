<?php
include_once 'logHeader.php';
include('../includes/config.php');

// Restrict access to admins only
if (!isset($_SESSION['user_id']) || $_SESSION['Acc_type'] !== 'Admin') {
    header("Location: ../login.php");
    exit();
}

// Check if the company ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $company_id = $_GET['id'];

    // Fetch the company's current details from the database
    $query = "SELECT company_name, company_type FROM companies WHERE company_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $company_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $company = $result->fetch_assoc();

        // Check if the company exists
        if (!$company) {
            echo "Company not found.";
            exit();
        }
        
        // Handle form submission for updating the company
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_name = $_POST['company_name'];
            $company_type = $_POST['company_type'];

            // Update the company details in the database
            $update_query = "UPDATE companies SET company_name = ?, company_type = ? WHERE company_id = ?";
            if ($update_stmt = $conn->prepare($update_query)) {
                $update_stmt->bind_param("ssi", $company_name, $company_type, $company_id);
                if ($update_stmt->execute()) {
                    header("Location: manage_companies.php");
                    exit();
                } else {
                    echo "Error updating company: " . $conn->error;
                }
                $update_stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Error fetching company details.";
    }
} else {
    echo "Invalid company ID.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
    <link rel="stylesheet" href="./CSS/manage_companies.css">
</head>
<body>
    <div class="edit-company-container">
        <h2>Edit Company Details</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name" id="company_name" value="<?php echo htmlspecialchars($company['company_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="company_type">Company Type:</label>
                <input type="text" name="company_type" id="company_type" value="<?php echo htmlspecialchars($company['company_type']); ?>" required>
            </div>
            <button type="submit" class="btn save-btn">Save Changes</button>
            <a href="manage_companies.php" class="btn cancel-btn">Cancel</a>
        </form>
    </div>
</body>
</html>
