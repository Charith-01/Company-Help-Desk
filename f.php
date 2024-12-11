<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Service Ticket</title>
    <link rel="stylesheet" href="f.css">
</head>
<body>
    <div class="form-container">
        <h1>IT Service Ticket</h1>
        <p>Please provide the details of the problem</p>
        <form id="ticket-form" action="submit_ticket.php" method="post" enctype="multipart/form-data">
            <!-- Name Section -->
            <div class="form-row">
                <div class="form-group">
                    <label for="first-name">Name</label>
                    <input type="text" id="first-name" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" placeholder="Last Name" required>
                </div>
            </div>
            <!-- Email Section -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="example@example.com" required>
            </div>
            <!-- Department & company ID -->
            <div class="form-row">
                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" id="department" name="department" required>
                </div>
                <div class="form-group">
                    <label for="company-id">Company ID</label>
                    <input type="text" id="company-id" name="company_id" required>
                </div>
            </div>
            <!-- Screenshot Upload -->
            <div class="form-group">
                <label for="screenshot">Upload Screenshot</label>
                <input type="file" id="screenshot" name="screenshot" required>
            </div>
            <!-- Problem Description -->
            <div class="form-group">
                <label for="problem-description">Describe the Problem</label>
                <textarea id="problem-description" name="problem_description" placeholder="Type here..." required></textarea>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>
</html>
