<?php
session_start();

if(array_key_exists('login', $_SESSION)) {
    header("Location:index.php");
    exit();
}

include "conn.php";

if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $conn->query("SELECT * FROM Users WHERE Email='$email'");
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["Password"] == $password) {
            $uid = $row["User_ID"];
            $prof_id = $conn->query("SELECT Profile_ID FROM Profiles WHERE User_ID='$uid'")->fetch_assoc()["Profile_ID"];
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["User_ID"];
            $_SESSION["profile"] = $prof_id;
            echo "<script> alert('Login Successful!') </script>";
            header("Location:userProfile.php");
            exit();
        } else {
            echo "<script> alert('Incorrect password!') </script>";
        }
    } else {
        echo "<script> alert('User does not exist!') </script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Finder Login</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <main>
        <div class="side_img">
            <img class="side" src="images/index.png">
        </div>
        <div class="loginbox">
        <h2>WELCOME BACK</h2>
        <div class="login">
            <div class="input_login">
                <form method="post" action="">
                    <label for="email">Enter Email:</label><br>
                    <input type="email" name="email" placeholder="Enter email" required><br><br>
                    <label for="email">Enter Password:</label><br>
                    <input type="password" name="password" placeholder="Enter password" required><br><br>
                    <button type="submit" name="submit">LOG IN</button>
                </form>
                <br><br>
                No account?<br>
                <a href="signup.php"><button type="button">CREATE ACCOUNT</button></a>
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