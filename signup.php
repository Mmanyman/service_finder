<?php
session_start();

if(array_key_exists('login', $_SESSION)) {
    header("Location:index.php");
    exit();
}

include "conn.php";

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $duplicate = $conn->query("SELECT * FROM Users WHERE Email='$email'");
    if ($duplicate->num_rows > 0){
        echo "<script> alert('Email already taken!') </script>";
    } else {
        if ($password == $cpassword) {
            $query = "INSERT INTO Users (`Email`, `Password`) VALUES ('$email', '$password')";
            $conn->query($query);
            $uid = $conn->query("SELECT User_ID FROM Users WHERE Email='$email'")->fetch_assoc()["User_ID"];
            $_SESSION["login"] = true;
            $_SESSION["id"] = $uid;
            echo "<script> alert('User registration successful!') </script>";
            header("Location:createProfile.php");
            exit();
        } else {
            echo "<script> alert('Password does not match!') </script>";
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Finder Signup</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <main>
        <div class="side_img">
            <img class="side" src="images/index.png">
        </div>
        <div class="signupbox">
        <h2>CREATE AN ACCOUNT</h2>
        <div class="login">
            <div class="input_login">
                <form action="" method="post" autocomplete="off">
                    <label for="email">Enter Email:</label><br>
                    <input type="email" name="email" placeholder="Enter email" required><br><br>
                    <label for="email">Enter Password:</label><br>
                    <input type="password" name="password" placeholder="Enter password" required><br><br>
                    <label for="email">Confirm Password:</label><br>
                    <input type="password" name="cpassword" placeholder="Confirm password" required><br><br><br>
                    <button type="submit" name="submit">CREATE ACCOUNT</button>
                </form>
            </div>
        </div>
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
    <script src="index.js"></script>
</body>

</html>