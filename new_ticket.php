<?php
include_once 'log_header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raise a New Ticket</title>
    <link rel="stylesheet" href="CSS/new_ticket.css">
</head>
<body>
   

    <!-- Ticket Form Section -->
    <section class="form-section">
        <div class="container">
            <h2>Raise a New Ticket</h2>
            <p>Please fill out the form below to raise a ticket. Our support team will respond shortly.</p>
            <form action="submit_ticket.php" method="POST" class="ticket-form">
                <label for="title">Issue Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Issue Description:</label>
                <textarea id="description" name="description" required></textarea>

                <button type="submit">Submit Ticket</button>
            </form>
        </div>
    </section>

    

    <?php
             include_once 'footer.php';

    ?>

    <script src="JS/script.js"></script>
</body>
</html>
