<?php

session_start();
require '../includes/config.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$UserID = $_SESSION["id"];
$fname = $_SESSION["full_name"];
$acctype =  $_SESSION["Acc_type"];

if($acctype != "Admin" && $acctype != "vendor"){

    echo "<script> alert ('You are not an Admin') 
        location.href='../login.php';
    </script> " ;
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wedding Whispers & Wonders</title>
        
		<link rel="stylesheet" href="./CSS/logheader.css">
    </head>
    <body>
	
		<header>
            
            <img src="./Images/logo.png" alt="logo" />
            <h1>Welcome</h1>

            <nav>
                <ul>
                    <a href="#"><img id="notify" src="./images/notifi.png" alt="logo"/></a>
                    <a href="myprofile.html"><img id="prof" src="./images/profile.png" alt="logo"/></a>
                    <a href="../includes/logout.php"><button type="button" id="lout">Logout</button></a>
                    
                
                </ul>
            </nav>
        </header>

       
        

    </body>  
</html>          