<?php
include_once 'log_header.php';

?>

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
    <title>Contact Support | IT Help Desk</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    

    <section class="section">
        <div class="container">
            <h2>Contact IT Support</h2>
            <form action="submit_ticket.php" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Your Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="issue">Describe the Issue:</label>
                <textarea name="issue" id="issue" rows="4" required></textarea>

                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </section>

    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
