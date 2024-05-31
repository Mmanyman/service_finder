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
    <link rel="stylesheet" href="css/userProfile.css">
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
                        echo '
                            <div class=\'detailsWrapper\'>  
                                <img class=\'busLogo\' src="' . $details["Logo"] . '">
                                
                                <div>
                                    <h1 class=\'busName\'>' . $details["Bsns_Name"] . '</h1>
                                    <div class=\'infoWrapper\'>
                                        <div class=\'info\'>
                                            <h5>' . $details["Category"] . '</h5>
                                            <h5> Street:     ' . $details["Address"] . '</h5>
                                            <h5>Landmark:     ' . $details["Landmark"] . '</h5>
                                        </div>
                                        <div class=\'info\'>
                                            <h5> Contact Person:     ' . $details["C_Person"] . '</h5>
                                            <h5> Email:     ' . $details["C_Email"] . '</h5>
                                            <h5> Contact Number:     ' . $details["C_Num"] . '</h5>
                                        </div>
                                        <div class=\'info\'>
                                            <h5>Opening Hours:     ' . $details["Hours_Open"] . '</h5>
                                            <h5>Price:     ' . $details["Price"] . '</h5>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        ';
                    
                    }else{//no logo uploaded
                        echo '
                        <div class=\'detailsWrapper\'>        
                        <div class=\'details\'>
                            <h1 class=\'busName\'>' . $details["Bsns_Name"] . '</h1>
                            <div class=\'infoWrapper\'>
                                <div class=\'info\'>
                                    <h5>' . $details["Category"] . '</h5>
                                    <h5> Street:     ' . $details["Address"] . '</h5>
                                    <h5>Landmark:     ' . $details["Landmark"] . '</h5>
                                </div>
                                <div class=\'info\'>
                                    <h5> Contact Person:     ' . $details["C_Person"] . '</h5>
                                    <h5> Email:     ' . $details["C_Email"] . '</h5>
                                    <h5> Contact Number:     ' . $details["C_Num"] . '</h5>
                                </div>
                                <div class=\'info\'>
                                    <h5>Opening Hours:     ' . $details["Hours_Open"] . '</h5>
                                    <h5>Price:     ' . $details["Price"] . '</h5>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                        
                    ';
                    
                    }

                ?>
            </div>
        </div >
        <div class="editWrap">
            <a href="editProfile.php"><button class="button" id="account" type="submit">EDIT PROFILE</button></a>
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
                    echo "<img src='" . $showcase1 . "' width='200px' height='200px' style='margin:30px;'>";
                }
                if ($showcase2 == NULL) {
                    echo "";
                } else {
                    echo "<img src='" . $showcase2 . "' width='200px' height='200px' style='margin:30px;'>";
                }
                if ($showcase3 == NULL) {
                    echo "";
                } else {
                    echo "<img src='" . $showcase3 . "' width='200px' height='200px' style='margin:30px;'>";
                }
            ?>

        </div>
        <?php include 'footer.php'; ?>
    </main>
</body>

</html>
