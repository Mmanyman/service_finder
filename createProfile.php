<?php
session_start();

if(!array_key_exists('login', $_SESSION)) {
  header("Location:index.php");
  exit();
}

$uid = $_SESSION["id"];

if(isset($_SESSION["profile"])) {
  header("Location:index.php");
  exit();
}

include "conn.php";

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

    $create_profile = "INSERT INTO Profiles (`User_Id`, `Bsns_Name`, `Category`, `Hours_Open`, `Price`, `Description`, `Barangay`, `Address`, `Landmark`, `C_Person`, `C_Num`, `C_Email`)
    VALUES ('$uid', '$name', '$category', '$hours', '$price', '$description', '$barangay', '$street', '$landmark', '$cperson', '$cnumber', '$cemail')";
    $conn->query($create_profile);
    echo "<script> alert('Profile created!') </script>";
    $prof_id = $conn->query("SELECT Profile_ID FROM Profiles WHERE User_ID='$uid'")->fetch_assoc()["Profile_ID"];
    
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
         $insert_profile = "UPDATE Profiles SET Logo='$profile' WHERE Profile_ID='$prof_id'";
         $conn->query($insert_profile);
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
         $insert_show1 = "INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 1, '$show1')";
         $conn->query($insert_show1);
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
         $insert_show2 = "INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 2, '$show2')";
         $conn->query($insert_show2);
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
         $insert_show3 = "INSERT INTO Showcase (`Profile_ID`, `Count`, `Image`) VALUES ('$prof_id', 3, '$show3')";
         $conn->query($insert_show3);
       }
      } else {
       echo "FILE FORMAT NOT SUPPORTED";
      }
    }
    
    $_SESSION["profile"] = $prof_id;
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

    <title>Create Profile</title>
  </head>
  <body>
      <div class="wrapper">
      <h1>CREATE PROFILE</h1>
          <main>
          <h4>About your service</h4>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="aboutServiceWrapper">
              <input type="text" placeholder="     Enter name" name="name" required/>
              <input type="text" placeholder="     Enter service hours" name="hours" required/>
              <textarea class="description" placeholder="     Enter business description" name="description"></textarea>
              <select name="category">
                <option value="Laundry">Laundry</option>
                <option value="Tech">Tech</option>
                <option value="Transportation">Transportation</option>
                <option value="Printing Services">Printing Services</option>
                <option value="Salon and Hair Care">Salon and Hair Care</option>
                <option value="Food and Catering">Food and Catering</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Cleaning Services">Cleaning Services</option>
                <option value="Fitness">Fitness</option>
                <option value="Delivery">Delivery</option>
                <option value="Home Repair">Home Repair</option>
                <option value="Automotive">Automotive</option>
                <option value="Cafe and Study Spaces">Cafes and Study Spaces</option>
                <option value="Others">Others</option>
              </select>
              <input type="text" placeholder="     Enter pricing" name="price" required/>
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
                <option value="Bacauan">Bacauan</option>
                <option value="Bagumbayan">Bagumbayan</option>
                <option value="Baraclayan">Baraclayan</option>
                <option value="Baybay Norte">Baybay Norte</option>
                <option value="Baybay Sur">Baybay Sur</option>
                <option value="Bolho">Bolho</option>
                <option value="Cabalaunan">Cabalaunan</option>
                <option value="Cagbang">Cagbang</option>
                <option value="Calagtangan">Calagtangan</option>
                <option value="Dalije">Dalije</option>
                <option value="Guibongan">Guibongan</option>
                <option value="Igbita">Igbita</option>
                <option value="Igdalaquit">Igdalaquit</option>
                <option value="Igdulaca">Igdulaca</option>
                <option value="Igpandan">Igpandan</option>
                <option value="Igtuba">Igtuba</option>
                <option value="Ilog-Ilog">Ilog-Ilog</option>
                <option value="Kirayan Norte">Kirayan Norte</option>
                <option value="Kirayan Sur">Kirayan Sur</option>
                <option value="Lanutan">Lanutan</option>
                <option value="Mat-y">Mat-y</option>
                <option value="Sapa">Sapa</option>
                <option value="Tacas">Tacas</option>
                <option value="Tumagboc">Tumagboc</option>
                <option value="Ubos Ilawod">Ubos Ilawod</option>
                <option value="Ubos Ilaya">Ubos Ilaya</option>
              </select>
              <input type="text" placeholder="     Enter street" name="street" required/>
              <input type="text" placeholder="     Enter landmark" name="landmark" required/>
            </div>
            <div class="contact">
              <h4>Contact Information</h4>
              <input type="text" placeholder="      Enter contact person" name="cperson" required/>
              <input type="email" placeholder="     Enter contact email" name="cemail" required/>
              <input type="text" placeholder="      Enter contact phone number" name="cnumber" required/>
            </div>
          </div>
          <button type="submit" class="submit" name="submit">SUBMIT</button>
        </form>
      </main>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>
