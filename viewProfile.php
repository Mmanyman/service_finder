<?php
session_start();

include "conn.php";

$prof_id = $_GET["Profile_ID"];
$details = $conn->query("SELECT * FROM Profiles WHERE Profile_ID='$prof_id'")->fetch_assoc();
$showcase1 = NULL;
$showcase2 = NULL;
$showcase3 = NULL;
if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 1")->num_rows > 0) {
    $showcase1 = $conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 1")->fetch_assoc()["Image"];
}
if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 2")->num_rows > 0) {
    $showcase2 = $conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 2")->fetch_assoc()["Image"];
}
if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 3")->num_rows > 0) {
    $showcase3 = $conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count = 3")->fetch_assoc()["Image"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Finder</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="index.js" defer></script>
</head>

<div>
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Service Finder Logo">
                <h1 class="title">Miagao Service Finder</h1>
                <?php 
            if(isset($_SESSION["id"])){
                echo '<div class="user-actions">
                        <a href="index.php"><button class="login-btn" id="logout" type="submit" >HOME</button></a>
                        <a href="logout.php"><button class="signup-btn" id="logout" type="submit">LOG OUT</button></a> 
                    </div>';
            }else{
                echo '<div class="user-actions">
                        <a href="login.php"><button class="login-btn">LOGIN</button></a>
                        <a href="signup.php"><button class="signup-btn">SIGN UP</button></a>
                      </div>';
            }
                ?>
            </div>
        </div>
    </header>
    <main>
        <div class="details">
            <div>
                <?php
                    if ($details["Logo"]){
                        echo "<img src='" . $details["Logo"] . "' height='100px'>"; 
                    }
                    echo 
                         "<br>Name: " . $details["Bsns_Name"] .
                         "<br>Category: " . $details["Category"] . 
                         "<br>Address: " . $details["Address"] . " | " . $details["Barangay"] .
                         "<br>Landmark: " . $details["Landmark"] .
                         "<br>Contact Person: " . $details["C_Person"] . 
                         "<br>Contact Email: " . $details["C_Email"] . 
                         "<br>Contact Number: " . $details["C_Num"] . 
                         "<br>Business Hours: " . $details["Hours_Open"] .
                         "<br>Pricing: " . $details["Price"];
                ?>
            </div>
        </div>
        <div class="description">
            <?php 
                echo "Description: " . $details["Description"];
            ?>
        </div>
        <div class="showcase">
            <?php
                if ($showcase1 == NULL) {
                    echo "";
                } else {
                    echo "<img src='" . $showcase1 . "' height='100px'>";
                }
                if ($showcase2 == NULL) {
                    echo "";
                } else {
                    echo "<img src='" . $showcase2 . "' height='100px'>";
                }
                if ($showcase3 == NULL) {
                    echo "";
                } else {
                    echo "<img src='" . $showcase3 . "' height='100px'>";
                }
            ?>

        </div>
        <footer>
            <div class="icons">
                <p> <i class="fa-solid fa-envelope"></i> CONTACT US </p>
                <p> <i class="fa-brands fa-github"></i> CONTRIBUTE </p>
                <p> <i class="fa-regular fa-circle-info"></i> ABOUT US </p>
            </div>
            <div class="credits">
                <p> <i class="fa-regular fa-copyright"></i> 2024 Miagao Service Finder. All rights reserved. </p>
            </div>
        </footer>
    </main>
</body>

</html>
