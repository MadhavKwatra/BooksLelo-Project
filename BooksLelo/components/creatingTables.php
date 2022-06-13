<?php

// creating Database 
$sql = "CREATE DATABASE booksleloDB";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h1>The Database Created Successfully<br></h1>";
} else {
    echo "<h1>The Database was not Created Successfully<br>Error:</h1>" . mysqli_error($conn);
}


// Creating ads table
$sql = "CREATE TABLE `bookslelodb`.`books` ( `b_id` INT(11) NOT NULL AUTO_INCREMENT ,  `b_title` VARCHAR(255) NOT NULL ,  `b_author` VARCHAR(255) NOT NULL ,  `b_sem` INT(4) NOT NULL ,  `b_course` VARCHAR(25) NOT NULL ,  `b_desc` TEXT NOT NULL ,  `b_photos` VARCHAR(255) NOT NULL ,  `b_price` INT(11) NOT NULL ,  `b_city` VARCHAR(255) NOT NULL ,  `b_timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `u_id` INT NOT NULL ,    PRIMARY KEY  (`b_id`)) ENGINE = InnoDB";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h1>The book table Created Successfully<br></h1>";
} else {
    echo "<h1>The book table was not Created Successfully<br>Error:</h1>" . mysqli_error($conn);
}

// Creating users table
$sql = "CREATE TABLE `bookslelodb`.`users` ( `u_id` INT(5) NOT NULL AUTO_INCREMENT ,  `u_username` VARCHAR(255) NOT NULL ,  `u_total_ads` INT(10) NOT NULL DEFAULT '0' ,  `u_phone` INT(15) NOT NULL ,  `u_fname` VARCHAR(50) NOT NULL ,  `u_lname` VARCHAR(50) NOT NULL ,  `u_pwd_hash` VARCHAR(255) NOT NULL ,   `u_timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,    PRIMARY KEY  (`u_id`)) ENGINE = InnoDB";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h1>The users table Created Successfully<br></h1>";
} else {
    echo "<h1>The users table was not Created Successfully<br>Error:</h1>" . mysqli_error($conn);
}
