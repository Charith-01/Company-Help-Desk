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
   
    <div class="breadcrumb-container">
        <nav class="breadcrumb">
            <a href="./home.php" class="breadcrumb-logo">
                <img src="./Images/logo.png" alt="Help Desk Logo" class="logo">
            </a>
            <a href="./home.php" class="breadcrumb-link">Help Center</a>
            <span class="breadcrumb-separator">></span>
            <a href="./knowledgebase.php" class="breadcrumb-link active">Raise Ticket</a>
        </nav>
    </div>


   

    <!-- Ticket Form Section -->
    <section class="form-section">
        <div class="container">
            <h2>Raise a New Ticket</h2>
            <p>Please fill out the form below to raise a ticket. Our support team will respond shortly.</p>
            <form action="submit_ticket.php" method="POST" class="ticket-form">
            <div class="inputbox">
                <label for="ticket_title">Ticket Title</label>
                <input type="text" id="ticket_title" name="ticket_title" required>
            </div>

            <!-- Ticket Description -->
            <div class="inputbox">
                <label for="ticket_description">Description</label>
                <textarea name="ticket_description" id="ticket_description" rows="5" required></textarea>
            </div>

            <!-- Issue Type -->
            <div class="inputbox">
                <label for="issue_type">Issue Type</label>
                <select name="issue_type" id="issue_type" required>
                    <option value="software">Software Issue</option>
                    <option value="hardware">Hardware Issue</option>
                    <option value="other">Other Issue</option>
                </select>
            </div>

            <!-- Select Company -->
            <div class="inputbox">
                <label for="company_id">Select Company</label>
                <select name="company_id" id="company_id" required>
                    <option value="1">Sub-Company 1</option>
                    <option value="2">Sub-Company 2</option>
                    <option value="3">Sub-Company 3</option>
                    <option value="4">Sub-Company 4</option>
                    <option value="5">Sub-Company 5</option>
                    <option value="6">Primary Company</option>
                </select>
            </div>

           

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
