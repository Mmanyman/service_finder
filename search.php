<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/searchstyle.css">
</head>

<body>
    <header class="search">
        <div class="logo">
            <img src="images/logo.png" alt="Service Finder Logo">
            <h1 class="title">Miagao Service Finder</h1>
        </div>
    </header>
    <div class="container"></div>
    <div class="search-container">
        <div class="search-nav">
            <form method="post" action="">
                <div class="search">
                    <input class="search-input" name="keyword" type="search" placeholder="Find Services" autocomplete="off">
                </div>
            <div class="back-btn">
                <button>BACK</button>
            </div>
        </div>
        <div class="search-result">
            <h2> Search Results </h2>
            <ul class="row-search-results">
                <li>
                    <?php
                        include "conn.php";
                        if(isset($_POST["submit"])) {
                            $query;
                            $barangay = $_POST["barangay"];
                            $category = $_POST["category"];
                            $keyword = $_POST["keyword"];

                            if ((!($barangay == "NONE")) && (!($category == "NONE")) && (!($keyword == ""))) {
                                $query = "SELECT * FROM Profiles WHERE Barangay='$barangay' OR Category='$category' OR Bsns_Name LIKE '%$category%' 
                                OR Description LIKE '%$category%' OR Description LIKE '%$keyword%' OR Bsns_Name LIKE '%$keyword%' ORDER BY Bsns_Name";
                            } 
                            else if (($barangay == "NONE") && (!($category == "NONE")) && (!($keyword == ""))) {
                                $query = "SELECT * FROM Profiles WHERE Category='$category' OR Bsns_Name LIKE '%$category%' 
                                OR Description LIKE '%$category%' OR Description LIKE '%$keyword%' OR Bsns_Name LIKE '%$keyword%' ORDER BY Bsns_Name";
                            } 
                            else if ((!($barangay == "NONE")) && ($category == "NONE") && (!($keyword == ""))) {
                                $query = "SELECT * FROM Profiles WHERE Barangay='$barangay' OR 
                                Description LIKE '%$keyword%' OR Bsns_Name LIKE '%$keyword%' ORDER BY Bsns_Name";
                            } 
                            else if ((!($barangay == "NONE")) && (!($category == "NONE")) && ($keyword == "")) {
                                $query = "SELECT * FROM Profiles WHERE Barangay='$barangay' OR Category='$category' OR Bsns_Name LIKE '%$category%' 
                                OR Description LIKE '%$category%' ORDER BY Bsns_Name";
                            } 
                            else if (($barangay == "NONE") && ($category == "NONE") && (!($keyword == ""))) {
                                $query = "SELECT * FROM Profiles WHERE Description LIKE '%$keyword%' OR Bsns_Name LIKE '%$keyword%' ORDER BY Bsns_Name";
                            } 
                            else if (($barangay == "NONE") && (!($category == "NONE")) && ($keyword == "")) {
                                $query = "SELECT * FROM Profiles WHERE Category='$category' OR Bsns_Name LIKE '%$category%' 
                                OR Description LIKE '%$category%' ORDER BY Bsns_Name";
                            } 
                            else if ((!($barangay == "NONE")) && ($category == "NONE") && ($keyword == "")) {
                                $query = "SELECT * FROM Profiles WHERE Barangay='$barangay' ORDER BY Bsns_Name";
                            }
                            else {
                                $query = "SELECT * FROM Profiles ORDER BY Bsns_Name";
                            }

                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <div class='result-item'>
                                    <div class='result-item-img'>
                                    <form action='viewProfile.php' method='get'>
                                        <input type='hidden' name='Profile_ID' value='". $row["Profile_ID"] ."'>
                                        <button type='submit' name='redirect_button'><img src='". $row["Logo"] ."' alt='Logo'></button>
                                    <form>
                                    </div>
                                    <div class='result-item-details'>
                                        <div class='result-name'>". $row["Bsns_Name"] . "</div>
                                        <div class='result-number'>". $row["C_Num"] ."</div>
                                        <div class='result-address'>". $row["Category"] ."</div>
                                    </div>
                                    </div>
                                    ";
                                }
                            } else {
                                echo "NO RESULTS FOUND!";
                            }
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="search-filter-panel">
        <div class="title">
            <h2> <i class="fa-solid fa-filter"></i> Search Filter</h2>
        </div>
        <div class="category-name">
            <p> Category</p>
        </div>
        <div class="checkbox-category">        
            <select class="input-label-pairs" name="category">
            <option value="NONE">Select Category</option>
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
        </div>
        <div class="category-name">
            <p> Location</p>
            <select class="input-label-pairs" name="barangay">
                <option value="NONE">Select Barangay</option>
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
        <div class="apply-btn">
            <button type="submit" name="submit">Apply</button>
        </div>
        </form>
    </div>
</body>

</html>