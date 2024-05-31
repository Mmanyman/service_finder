<?php
session_start();

if(!array_key_exists('login', $_SESSION)) {
    header("Location:index.php");
    exit();
}

include "conn.php";
$uid = $_SESSION["id"];
$prof_id = $_SESSION["profile"];
$details = $conn->query("SELECT * FROM Profiles WHERE Profile_ID='$prof_id'")->fetch_assoc();

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $hours = $_POST["hours"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $barangay = $_POST["barangay"];
    $street = $_POST["street"];
    $landmark = $_POST["landmark"];
    $cperson = $_POST["cperson"];
    $cemail = $_POST["cemail"];
    $cnumber = $_POST["cnumber"];

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
      $profName = $_FILES['profile']['name'];
      $profTmpName = $_FILES['profile']['tmp_name'];
      $profError = $_FILES['profile']['error'];
     
      $profExt = explode('.', $profName);
      $profActualExt = strtolower(end($profExt));
      $allowed = array('jpg', 'jpeg', 'png');
 
      if (in_array($profActualExt, $allowed)) {
       if ($profError === 0) {
         $profNameNew = "profile" . $prof_id . "_" . mt_rand() . "." . $profActualExt;
         $profile = 'uploads/profile/' . $profNameNew;
         move_uploaded_file($profTmpName, $profile);
         $update_logo = "UPDATE Profiles SET Logo='$profile' WHERE Profile_ID='$prof_id'";
         $conn->query($update_logo);
       }
      } else {
       echo "FILE FORMAT NOT SUPPORTED";
      }
    } 

    if (isset($_FILES['file1']) && $_FILES['file1']['error'] === UPLOAD_ERR_OK) {
      $show1Name = $_FILES['file1']['name'];
      $show1TmpName = $_FILES['file1']['tmp_name'];
      $show1Error = $_FILES['file1']['error'];
     
      $show1Ext = explode('.', $show1Name);
      $show1ActualExt = strtolower(end($show1Ext));
      $allowed = array('jpg', 'jpeg', 'png');
 
      if (in_array($show1ActualExt, $allowed)) {
       if ($show1Error === 0) {
         $show1NameNew = "1show" . $prof_id . "_" . mt_rand() . "." . $show1ActualExt;
         $show1 = 'uploads/showcase/' . $show1NameNew;
         move_uploaded_file($show1TmpName, $show1);
         if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count=1")->num_rows > 0) {
            $conn->query("UPDATE Showcase SET Image='$show1' WHERE Profile_ID='$prof_id' AND Count=1");
         } else {
            $conn->query("INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 1, '$show1')");
         }
       }
      } else {
       echo "FILE FORMAT NOT SUPPORTED";
      }
    }

    if (isset($_FILES['file2']) && $_FILES['file2']['error'] === UPLOAD_ERR_OK) {
      $show2Name = $_FILES['file2']['name'];
      $show2TmpName = $_FILES['file2']['tmp_name'];
      $show2Error = $_FILES['file2']['error'];
     
      $show2Ext = explode('.', $show2Name);
      $show2ActualExt = strtolower(end($show2Ext));
      $allowed = array('jpg', 'jpeg', 'png');
 
      if (in_array($show2ActualExt, $allowed)) {
       if ($show2Error === 0) {
         $show2NameNew = "2show" . $prof_id . "_" . mt_rand() . "." . $show2ActualExt;
         $show2 = 'uploads/showcase/' . $show2NameNew;
         move_uploaded_file($show2TmpName, $show2);
         if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count=2")->num_rows > 0) {
          $conn->query("UPDATE Showcase SET Image='$show2' WHERE Profile_ID='$prof_id' AND Count=2");
         } else {
          $conn->query("INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 2, '$show2')");
         }
       }
      } else {
       echo "FILE FORMAT NOT SUPPORTED";
      }
    }

    if (isset($_FILES['file3']) && $_FILES['file3']['error'] === UPLOAD_ERR_OK) {
      $show3Name = $_FILES['file3']['name'];
      $show3TmpName = $_FILES['file3']['tmp_name'];
      $show3Error = $_FILES['file3']['error'];
     
      $show3Ext = explode('.', $show3Name);
      $show3ActualExt = strtolower(end($show3Ext));
      $allowed = array('jpg', 'jpeg', 'png');
 
      if (in_array($show3ActualExt, $allowed)) {
       if ($show3Error === 0) {
         $show3NameNew = "3show" . $prof_id . "_" . mt_rand() . "." . $show3ActualExt;
         $show3 = 'uploads/showcase/' . $show3NameNew;
         move_uploaded_file($show3TmpName, $show3);
         if ($conn->query("SELECT * FROM Showcase WHERE Profile_ID='$prof_id' AND Count=3")->num_rows > 0) {
          $conn->query("UPDATE Showcase SET Image='$show3' WHERE Profile_ID='$prof_id' AND Count=3");
         } else {
          $conn->query("INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 3, '$show3')");
        }
       }
      } else {
       echo "FILE FORMAT NOT SUPPORTED";
      }
    }

    $update_profile = "UPDATE Profiles SET Bsns_Name='$name', Category='$category', Hours_Open='$hours', Price='$price', Description='$description', 
                      Barangay='$barangay', Address='$street', Landmark='$landmark', C_Person='$cperson', C_Num='$cnumber', C_Email='$cemail' WHERE Profile_ID='$prof_id'";
    $conn->query($update_profile);
    echo "<script> alert('Profile updated!') </script>";
    header("Location:userProfile.php");
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/editProfile.css" />
    <link rel="stylesheet" href="css/editProfile_ext.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Edit Profile</title>
  </head>
  <body>
    <div class="wrapper">
      <h1>EDIT PROFILE</h1>
      <div class="backWrap">
        <button class="back" onclick="history.go(-1);">BACK</button> 
      </div>
 
      <main>
          <h4>About your service</h4>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="aboutServiceWrapper">
                <input type="text" placeholder="Enter name" name="name" value="     <?= htmlspecialchars($details["Bsns_Name"] ?? '') ?>" required/>
                <input type="text" placeholder="Enter service hours" name="hours" value="      <?= htmlspecialchars($details["Hours_Open"] ?? '') ?>" required/>
                <textarea class="description" placeholder="Enter business description" name="description">     <?= htmlspecialchars($details["Description"]) ?></textarea>
                <select name="category">
                  <option value="Laundry" <?= $details['Category'] == 'Laundry' ? 'selected' : '' ?>>     Laundry</option>
                  <option value="Tech" <?= $details['Category'] == 'Tech' ? 'selectec' : '' ?>>     Tech</option>
                  <option value="Transportation" <?= $details['Category'] == 'Laundry' ? 'selected' : '' ?>>     Transportation</option>
                  <option value="Printing Services" <?= $details['Category'] == 'Printing Services' ? 'selected' : '' ?>>     Printing Services</option>
                  <option value="Salon and Hair Care" <?= $details['Category'] == 'Salon and Hair Care' ? 'selected' : '' ?>>    Salon and Hair Care</option>
                  <option value="Food and Catering" <?= $details['Category'] == 'Food and Catering' ? 'selected' : '' ?>>     Food and Catering</option>
                  <option value="Healthcare" <?= $details['Category'] == 'Healthcare' ? 'selected' : '' ?>>     Healthcare</option>
                  <option value="Cleaning Services" <?= $details['Category'] == 'Cleaning Services' ? 'selected' : '' ?>>     Cleaning Services</option>
                  <option value="Fitness" <?= $details['Category'] == 'Fitness' ? 'selected' : '' ?>>     Fitness</option>
                  <option value="Delivery" <?= $details['Category'] == 'Delivery' ? 'selected' : '' ?>>     Delivery</option>
                  <option value="Home Repair" <?= $details['Category'] == 'Home Repair' ? 'selected' : '' ?>>     Home Repair</option>
                  <option value="Automotive" <?= $details['Category'] == 'Automative' ? 'selected' : '' ?>>     Automotive</option>
                  <option value="Cafe and Study Spaces" <?= $details['Category'] == 'Cafe and Study Spaces' ? 'selected' : '' ?>>    Cafes and Study Spaces</option>
                  <option value="Others" <?= $details['Category'] == 'Others' ? 'selected' : '' ?>>     Others</option>
                </select>
                <input type="text" placeholder="Enter pricing" name="price" value="     <?= htmlspecialchars($details["Price"] ?? '') ?>" required/>
            </div>
            </div>
            <br><br>
            <div class="upload">
              <div class="profile">
                <h3>Profile Picture</h3>
                <input type="file" id="profile" name="profile"><br /><br />
              </div>
              <div class="showcase">
                <h3>Showcase 1</h3>
                <input type="file" id="file1" name="file1"><br /><br />
              </div>
              <div class="showcase">
                <h3>Showcase 2</h3>
                <input type="file" id="file2" name="file2"><br /><br />
              </div>
              <div class="showcase">
                <h3>Showcase 3</h3>
                <input type="file" id="file3" name="file3"><br /><br />
              </div>
            </div>
            <div class="otherInfo">
              <div class="address">
                <h4>Address</h4>
                <select name="barangay">
                  <option value="Bacauan" <?= $details['Barangay'] == 'Bacauan' ? 'selected' : '' ?>>Bacauan</option>
                  <option value="Bagumbayan" <?= $details['Barangay'] == 'Bagumbayan' ? 'selected' : '' ?>>Bagumbayan</option>
                  <option value="Baraclayan" <?= $details['Barangay'] == 'Baraclayan' ? 'selected' : '' ?>>Baraclayan</option>
                  <option value="Baybay Norte" <?= $details['Barangay'] == 'Baybay Norte' ? 'selected' : '' ?>>Baybay Norte</option>
                  <option value="Baybay Sur" <?= $details['Barangay'] == 'Baybay Sur' ? 'selected' : '' ?>>Baybay Sur</option>
                  <option value="Bolho" <?= $details['Barangay'] == 'Bolho' ? 'selected' : '' ?>>Bolho</option>
                  <option value="Cabalaunan" <?= $details['Barangay'] == 'Cabalaunan' ? 'selected' : '' ?>>Cabalaunan</option>
                  <option value="Cagbang" <?= $details['Barangay'] == 'Cagbang' ? 'selected' : '' ?>>Cagbang</option>
                  <option value="Calagtangan" <?= $details['Barangay'] == 'Calagtangan' ? 'selected' : '' ?>>Calagtangan</option>
                  <option value="Dalije" <?= $details['Barangay'] == 'Dalije' ? 'selected' : '' ?>>Dalije</option>
                  <option value="Duyan-Duyan" <?= $details['Barangay'] == 'Duyan-Duyan' ? 'selected' : '' ?>>Duyan-Duyan</option>
                  <option value="Guibongan" <?= $details['Barangay'] == 'Guibongan' ? 'selected' : '' ?>>Guibongan</option>
                  <option value="Igbita" <?= $details['Barangay'] == 'Igbita' ? 'selected' : '' ?>>Igbita</option>
                  <option value="Igdalaquit" <?= $details['Barangay'] == 'Igdalaquit' ? 'selected' : '' ?>>Igdalaquit</option>
                  <option value="Igdulaca" <?= $details['Barangay'] == 'Igdulaca' ? 'selected' : '' ?>>Igdulaca</option>
                  <option value="Igpandan" <?= $details['Barangay'] == 'Igpandan' ? 'selected' : '' ?>>Igpandan</option>
                  <option value="Igtuba" <?= $details['Barangay'] == 'Igtuba' ? 'selected' : '' ?>>Igtuba</option>
                  <option value="Ilog-Ilog" <?= $details['Barangay'] == 'Ilog-Ilog' ? 'selected' : '' ?>>Ilog-Ilog</option>
                  <option value="Kirayan Norte" <?= $details['Barangay'] == 'Kirayan Norte' ? 'selected' : '' ?>>Kirayan Norte</option>
                  <option value="Kirayan Sur" <?= $details['Barangay'] == 'Kirayan Sur' ? 'selected' : '' ?>>Kirayan Sur</option>
                  <option value="Lanutan" <?= $details['Barangay'] == 'Lanutan' ? 'selected' : '' ?>>Lanutan</option>
                  <option value="Mat-y" <?= $details['Barangay'] == 'Mat-y' ? 'selected' : '' ?>>Mat-y</option>
                  <option value="Sapa" <?= $details['Barangay'] == 'Sapa' ? 'selected' : '' ?>>Sapa</option>
                  <option value="Tacas" <?= $details['Barangay'] == 'Tacas' ? 'selected' : '' ?>>Tacas</option>
                  <option value="Tumagboc" <?= $details['Barangay'] == 'Tumagboc' ? 'selected' : '' ?>>Tumagboc</option>
                  <option value="Ubos Ilawod" <?= $details['Barangay'] == 'Ubos Ilawod' ? 'selected' : '' ?>>Ubos Ilawod</option>
                  <option value="Ubos Ilaya" <?= $details['Barangay'] == 'Ubos Ilaya' ? 'selected' : '' ?>>Ubos Ilaya</option>
                </select>
                <input type="text" placeholder="Enter street" name="street" value="     <?= htmlspecialchars($details["Address"] ?? '') ?>" required/>
                <input type="text" placeholder="Enter landmark" name="landmark" value="     <?= htmlspecialchars($details["Landmark"] ?? '') ?>" required/>
              </div>
              <div class="contact">
                <h4>Contact Information</h4>
                <input type="text" placeholder="Enter contact person" name="cperson" value="     <?= htmlspecialchars($details["C_Person"] ?? '') ?>" required/>
                <input type="email" placeholder="Enter contact email" name="cemail" value="     <?= htmlspecialchars($details["C_Email"] ?? '') ?>" required/>
                <input type="text" placeholder="Enter contact phone number" name="cnumber" value="    <?= htmlspecialchars($details["C_Num"] ?? '') ?>" required/>
              </div>
            </div>
            <button type="submit" class="submit" name="submit">SUBMIT</button>
        </form>
      </main>
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
  </body>
</html>
