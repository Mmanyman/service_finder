<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Finder</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Service Finder Logo">
                <h1 class="title">Miagao Service Finder</h1>
                <?php 
            if(isset($_SESSION["id"])){
                echo '<div class="user-actions">
                        <a href="userProfile.php"><button class="login-btn" id="account" type="submit" >ACCOUNT</button></a>
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
        <div class="container">
            <p class="service">SERVICE FINDER</p>
            <form>
                <div class="search">
                    <i class="search-icon fa-solid fa-magnifying-glass"></i>
                    <a href="search.php"><button type="submit" class="signup-btn">START SEARCH</button></a>
                </div>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </main>
</body>

</html>