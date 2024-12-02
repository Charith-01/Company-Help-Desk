
<?php
include_once 'header.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Help Desk</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h2>How can we assist you today?</h2>
            <form id="search-form" method="POST" action="search.php">
                <input type="text" name="query" placeholder="Search knowledgebase or tickets..." required>
                <button type="submit">Search</button>
            </form>
        </div>
    </section>

    <!-- Raise a New Ticket Section -->
    <section id="raise-ticket" class="ticket">
        <div class="container">
            <h2>Need Assistance?</h2>
            <p>If you're experiencing technical issues, raise a ticket and our support team will get back to you promptly.</p>
            <a href="new_ticket.php" class="btn">Raise a New Ticket</a>
        </div>
    </section>

    <!-- Knowledgebase Section -->
    <section id="knowledgebase" class="section">
        <div class="container">
            <h2>Knowledgebase</h2>
            <div class="cards">
                <div class="card">
                    <h3>General FAQs</h3>
                    <p>Find answers to frequently asked questions related to IT support and services.</p>
                    <a href="general.php">View Articles</a>
                </div>
                <div class="card">
                    <h3>Software Help</h3>
                    <p>Explore troubleshooting guides and FAQs for the software tools provided by IT.</p>
                    <a href="software.php">View Articles</a>
                </div>
                <div class="card">
                    <h3>Hardware Support</h3>
                    <p>Get assistance with hardware-related issues such as device malfunctions and configurations.</p>
                    <a href="hardware.php">View Articles</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Support Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact IT Support</h2>
            <p>If you cannot find the solution to your problem, reach out to our support team directly.</p>
            <a href="contact.php" class="btn">Contact Support</a>
        </div>
    </section>

    <?php
             include_once 'footer.php';
    ?>
</body>
</html>
