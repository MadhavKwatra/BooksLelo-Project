<?php
// connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookslelodb";


// connection established or not
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Cant Establish Connection " . mysqli_connect_error());
} else {
    // echo "Congratulations You established the Connection successfully<br>";
}
