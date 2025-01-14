<?php
// Include header and database connection
include_once 'log_header.php'; 
include_once 'includes/config.php'; // Assume this connects to your database

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the search query from the form submission
if (isset($_POST['query'])) {
    $query = $_POST['query'];
    // Sanitize the input to prevent SQL injection
    $query = mysqli_real_escape_string($conn, $query);
} else {
    // If no query is entered, redirect to home page
    header("Location: home.php");
    exit;
}

// SQL query to search in the knowledgebase and tickets (example)
$sql = "
    SELECT 'user' AS source, id, title, content FROM users WHERE title LIKE '%$query%' OR content LIKE '%$query%'
    UNION
    SELECT 'ticket' AS source, id, title, description AS content FROM tickets WHERE title LIKE '%$query%' OR description LIKE '%$query%'
";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    // Display results
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='search-result'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars(substr($row['content'], 0, 150)) . "...</p>";
        // Check the source to determine the link
        if ($row['source'] == 'user') {
            echo "<a href='user.php?id=" . $row['id'] . "'>Read More</a>";
        } elseif ($row['source'] == 'ticket') {
            echo "<a href='ticket.php?id=" . $row['id'] . "'>Read More</a>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No results found for '$query'.</p>";
}
?>

<!-- Add footer -->
<?php include_once '../common/footer.php'; ?>
