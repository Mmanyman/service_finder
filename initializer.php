<?php
    $conn = new mysqli("localhost", "root", "");

    $create_DB = "CREATE DATABASE IF NOT EXISTS ServiceFinder";
    $conn->query($create_DB);
    $conn->close();

    $conn = new mysqli("localhost", "root", "", "ServiceFinder");

    $create_user_table = "CREATE TABLE IF NOT EXISTS `Users` (
        `User_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
        `Email` varchar(255) NOT NULL,
        `Password` varchar(255) NOT NULL,
        PRIMARY KEY(`User_ID`)
    )";
    $conn->query($create_user_table);

    $create_profile_table = "CREATE TABLE IF NOT EXISTS `Profiles` (
        `Profile_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
        `User_ID` int(5) UNSIGNED NOT NULL,
        `Bsns_Name` varchar(255) NOT NULL,
        `Category` varchar(255),
        `Logo` varchar(255),
        `Hours_Open` varchar(255),
        `Price` varchar(255),
        `Description` varchar(5000),
        `Barangay` varchar(255),
        `Address` varchar(255),
        `Landmark` varchar(255),
        `C_Person` varchar(255),
        `C_Num` varchar(255),
        `C_Email` varchar(255),
        PRIMARY KEY(`Profile_ID`),
        FOREIGN KEY(`User_ID`) REFERENCES Users(`User_ID`)
    )";
    $conn->query($create_profile_table);

    $create_showcase_table = "CREATE TABLE IF NOT EXISTS `Showcase` (
        `Showcase_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
        `Profile_ID` int(5) UNSIGNED NOT NULL,
        `Count` int(1) UNSIGNED,
        `Image` varchar(255),
        PRIMARY KEY(`Showcase_ID`),
        FOREIGN KEY(`Profile_ID`) REFERENCES Profiles(`Profile_ID`)
    )";
    $conn->query($create_showcase_table);

    $conn->close();
?>