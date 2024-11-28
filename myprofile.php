<?php

require 'includes/config.php';

if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
    header("Location: login.php?error=mustlogin");
    exit;
}
$UserID = $_SESSION["uid"];
$fname = $_SESSION["fname"];

?>

<?php

$sql = "SELECT * FROM user_details WHERE user_id = $UserID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $profile = array();
        $profile["UserID"] = $row["user_id"];
        $profile["FullName"] = $row["fname"] . " " . $row["lname"];
        $profile["Email"] = $row["email"];
        $profile["Password"] = $row["password"];
    }
} else {
    echo "No data found!";
}

$conn->close();
?>

<link rel="stylesheet" href="./CSS/myprofile.css">

<main>
    <section class="main-banner">
        <div>
            <center>
                <img src="./images/userprofile/icon-256x256 1.png" style="margin-top: 15px;">
                <div class="welcome-msg">
                    <h2>Hello, 
                        <?php
                            if (isset($_SESSION["fname"])) {
                                echo $profile["FullName"];
                            } else {
                                echo "User";
                            }
                        ?>, welcome back!
                    </h2>
                </div>
            </center>
        </div>
    </section>

    <div class="user-container">
        <div class="user-sidebar">
            <ul class="user-menu">
                <li><a href="./myprofile.php">My Details</a></li>
                <li><a href="./myorders.php">My Orders</a></li>
                <li><a href="./mycart.php">My Cart</a></li>
            </ul>
        </div>

        <section class="details-section">
            <div class="welcome-msg">
                <center><h2 style="margin-top: 30px;">My Profile</h2></center>
            </div>

            <div class="my-details">
                <center><h2 style="margin-top: 12px;">My Details</h2></center>

                <div class="detail-container">
                    <p><strong>User ID: <?php echo $profile["UserID"]; ?></strong></p>
                    <p><strong>Full Name: <?php echo $profile["FullName"]; ?></strong></p>
                    <p><strong>Email: <?php echo $profile["Email"]; ?></strong></p>
                </div>
            </div>

            <form action="./edituser.php" method="POST">
                <div class="edit-details">
                    <center><h2 style="margin-top: 10px;">Edit Details</h2></center>
                    <div class="edit-container">
                        <p><strong>Full Name:</strong></p>
                        <input type="text" name="fullname" value="<?php echo $profile["FullName"]; ?>">

                        <p><strong>Email:</strong></p>
                        <input type="email" name="email" value="<?php echo $profile["Email"]; ?>">

                        <p><strong>Password:</strong></p>
                        <input type="password" name="password" value="<?php echo $profile["Password"]; ?>">

                        <p><strong>Confirm Password:</strong></p>
                        <input type="password" name="c_password">

                        <br><div class="update"><input type="submit" name="submit" value="UPDATE" class="submit"></div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>
</body>
</html>

<footer id="footer">
    <div>
        <div>
            <img src="./Src/Images/logo/white-logo.png" alt="">
            <img src="./Src/Images/footer/Planner 1.png" alt="">
            
            <ul>
                <a href="./index.php"><li>Home</li></a>
                <a href="./service.php"><li>Services</li></a>
                <a href="./LogAboutus.php"><li>About</li></a>
                <a href="#"><li>Work</li></a>
                <a href="./LogContact.php"><li>Contact</li></a>
                <a href="./privacy_policy.php"><li>Privacy Policy</li></a>
            </ul>
            <ul>
                <a href="#"><li>Facebook</li></a>
                <a href="#"><li>Youtube</li></a>
                <a href="#"><li>Instagram</li></a>
                <a href="#"><li>Email</li></a>
                <a href="#"><li>Call us</li></a>
            </ul>
        </div>
        <h3>Quick links</h3>
        <h3>Contact Us</h3>
        <p>All Rights Reserved - 2023 Designed by SLIIT Matara Center, Group 04</p>
    </div>
</footer>
