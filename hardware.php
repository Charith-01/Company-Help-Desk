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
    <title>Hardware Support | IT Help Desk</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    

    <section class="section">
        <div class="container">
            <h2>Hardware Support</h2>
            <div class="faq">
                <h3>How to Fix Printer Issues?</h3>
                <p>If your printer is not responding, ensure it is connected to the network, check for paper jams, and make sure the drivers are up to date...</p>
            </div>
            <div class="faq">
                <h3>How to Troubleshoot a Slow Computer?</h3>
                <p>To speed up your computer, check for unnecessary startup programs, free up disk space, and ensure all drivers are up to date...</p>
            </div>
        </div>
    </section>

    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
