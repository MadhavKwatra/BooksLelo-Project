<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'ConnectingToDB.php';

    $username = $_POST["username"];
    $pwd = $_POST["password"];

    // if username exists
    $sql = "SELECT * FROM `users` WHERE `u_username`='$username'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pwd, $row['u_pwd_hash'])) {

            // starting session
            session_start();
            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["userId"] = $row['u_id'];

            // redirecting to homepage
            header("Location: /bookslelo?loggedIn=true&user=$username");
        } else {

            // dont remember password
            header("Location: /bookslelo?loggedIn=false&user=$username");
        }
    } else {
        // username dont exist
        header("Location: /bookslelo?loggedIn=false");
    }
}
