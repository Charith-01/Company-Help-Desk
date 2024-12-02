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
    <title>Software Troubleshooting | IT Help Desk</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    

    <section class="section">
        <div class="container">
            <h2>Software Troubleshooting</h2>
            <div class="faq">
                <h3>How to Fix Software Crashes?</h3>
                <p>If your software crashes unexpectedly, try restarting your computer, checking for updates, or reinstalling the software...</p>
            </div>
            <div class="faq">
                <h3>How to Resolve Software Compatibility Issues?</h3>
                <p>Ensure your software is compatible with the system version. If not, try using compatibility mode...</p>
            </div>
        </div>
    </section>

    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
