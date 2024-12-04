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
    <title>General FAQs | IT Help Desk</title>
    <link rel="stylesheet" href="CSS/knowledgebase.css">
</head>
<body>
  

    <section class="section">
        <div class="container">
            <h2>General FAQs</h2>
            <div class="faq">
                <h3>How to Raise a Ticket?</h3>
                <p>Follow these steps to raise a support ticket...</p>
            </div>
            <div class="faq">
                <h3>What Is the IT Support Policy?</h3>
                <p>Our IT support policy outlines the support level and response time...</p>
            </div>
            <div class="faq">
                <h3>How Can I Reset My Password?</h3>
                <p>To reset your password, follow these steps...</p>
            </div>
        </div>
    </section>

    <div class="knowledgebase">
        <h1><span class="icon">💡</span> Knowledgebase</h1>
        <div class="categories">
            <div class="category">
                <div class="icon-folder"></div>
                <h2>General (36)</h2>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">What is Help Desk</a></li>
                    <li><a href="#">Semester Registration</a></li>
                    <li><a href="#">What is Eduscope?</a></li>
                    <li><a href="#">Rules and Regulations for users</a></li>
                </ul>
               
            </div>
            <div class="category">
                <div class="icon-folder"></div>
                <h2>Verification (1)</h2>
                <ul>
                    <li><a href="#">Credit Conversions to European Credit Transfer...</a></li>
                </ul>
           
            </div>
        </div>
  </div>
  <script src="script.js"></script>

    <?php
             include_once 'footer.php';

    ?>
</body>
</html>
