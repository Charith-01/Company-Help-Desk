<?php
include_once 'log_header.php';

?>
<?php
/*session_start();
require_once '../includes/config.php';


// Fetches form data sent via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $mail = $_POST['mail'];
    $pnum = $_POST['pnum'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];
    $pw1 = password_hash($_POST['pw1'], PASSWORD_DEFAULT); // Hashes the password for security.

    // Validate all fields are filled.
    if (empty($fullname) || empty($user_name) || empty($mail) || empty($pnum) || empty($age) || empty($gender) || empty($height) || empty($weight) || empty($bmi) || empty($pw1)) {
        $error = "All fields are required.";
    } else {
        // Check if username already exists.
        $stmt = $conn->prepare("SELECT * FROM user_registration WHERE user_name = ?"); //Can't directly inserting user input into the query (SQL injection attacks ex-?).
        $stmt->bind_param("s", $user_name); // Bind the username as a string parameter
        $stmt->execute(); //Execute the quary and send DB.
        $stmt->store_result(); //Stores the result set in the statement.

        if ($stmt->num_rows > 0) {
            $error = "Username already exists.";
        } else {
            // Insert data in to user_registration table.
            $stmt = $conn->prepare("INSERT INTO user_registration (full_name, user_name, mail, pnum, age, gender, height, weight, bmi, pw1) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssisssss", $fullname, $user_name, $mail, $pnum, $age, $gender, $height, $weight, $bmi, $pw1); //Bind the data as a string and intiger parameter.
            
            if ($stmt->execute()) {
                $_SESSION['user_name'] = $user_name;
                header("Location: profile.php");
                exit;
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        $stmt->close(); // Close the prepared statement
    }
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/ticket.css">
    <script src="../js/myscript.js"></script>
</head>
<body>
    <div class="ticket-form-container">
        <header>IT Service Ticket</header>
        <p>Please fill out the form below to raise a ticket. Our support team will respond shortly.</p>
        <form method="POST" action="" class="ticket-form">
            <div class="form-group">
                <label for="frist_name">First Name</label>
                <input type="text" name="frist_name" id="frist_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>
            <div class="form-group">
                <label for="mail">Email</label>
                <input type="email" name="mail" id="mail" required>
            </div>
            <div class="form-group">
                <label for="pnum">Phone Number</label>
                <!-- Use pattern for phone number -->
                <input type="text" name="pnum" pattern="[0-9]{10}" id="pnum" required>
            </div>
            <div class="form-group">
                <label for="branch">Select Branch</label>
                <select name="branch" id="branch">
                    <option value="head_office">Select Your Branch</option>
                    <option value="head_office">Head Office</option>
                    <option value="sub_company_1">Sub Company 1</option>
                    <option value="sub_company_2">Sub Company 2</option>
                    <option value="sub_company_3">Sub Company 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="problem">Select Problem</label>
                <select name="problem" id="problem">
                    <option value="problem_1">Select Your Problem</option>
                    <option value="problem_1">Problem 1</option>
                    <option value="problem_2">Problem 2</option>
                    <option value="problem_3">Problem 3</option>
                    <option value="problem_4">Problem 4</option>
                </select>
            </div>
            <div class="form-group">
            <label for="">Discribe Your Problem</label>
                <textarea id="problem_dis"></textarea>
            </div>
            
            <button type="submit" class="submit-button">Submit</button>
            
        </form>
    </div>
</body>
</html>


<?php
             include_once 'footer.php';

    ?>
