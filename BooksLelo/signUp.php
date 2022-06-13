<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'components/ConnectingToDB.php';

  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $fname = strtolower($_POST["fname"]);
  $lname = strtolower($_POST["lname"]);
  $phone = $_POST["phone"];

  // if username exists
  $sql = "SELECT * FROM `users` WHERE `u_username`='$username'";
  $result = mysqli_query($conn, $sql);
  $numRows = mysqli_num_rows($result);

  if ($numRows > 0) {


    echo "Username Exists";
  } else {

    // inserting into users DB with hash of password

    $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);


    $sql = "INSERT INTO `users` (`u_username`, `u_phone`, `u_fname`, `u_lname`, `u_pwd_hash`, `u_timestamp`) VALUES ('$username', '$phone', '$fname', '$lname', '$pwdHash', current_timestamp())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("location:/bookslelo?accountCreated=true");
    } else {
      echo "Something is not Working right .Try again later. SOrry for the inconvenience.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/postStyle.css" />
  <style>
    label {
      font-size: 1.2rem;
      font-weight: 600;
    }

    p.info {
      color: grey;
      font-size: smaller;
      margin-top: 0.7em;
    }

    button.submitBtn {
      font-size: 1.5rem;
      width: 100%;
      padding: 00.5em;
      border: none;
      background-color: aqua;
      margin-top: 1em;
      margin-bottom: 0.4em;
      border-radius: 0.5em;
      color: #000;
    }
  </style>
  <title>Create your account - Bookslelo</title>
</head>

<body>
  <header>
    <!-- Back Icon -->
    <a href="/bookslelo">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="back">
        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com div class="form-control"cense - https://fontawesome.com/div class="form-control"cense (Commercial div class="form-control"cense) Copyright 2022 Fonticons, Inc. -->
        <path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z" />
      </svg>
    </a>
    <h1>Create your account</h1>
  </header>
  <main class="container">
    <form action="signUp.php" method="POST">
      <div class="form-control">
        <label for="fname">First name</label>
        <input type="text" id="fname" pattern="[a-zA-Z]{1,50}" maxlength="50" name="fname" title="Only alphabets are allowed" required>
      </div>
      <div class="form-control">
        <label for="lname">Last name</label>
        <input type="text" pattern="[a-zA-Z]{1,50}" title="Only alphabets are allowed" maxlength="50" id="lname" name="lname" required>
      </div>
      <div class="form-control">
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd" minlength="8" required>
        <p class="info">Password must be of 8 characters long or more.Use mix of letters,symbols & numbers to make your password strong. </p>
      </div>
      <div class="form-control">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="madhav_2000" pattern="[a-z][a-z0-9_]{4,8}" title="It must start with a letter.You can use lowercase letters,underscore and numbers only.It must be of 4-8 characters length." required />
        <p class="info">The username will be used to uniquely identify you.</p>
      </div>
      <div class="form-control">
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" placeholder="e.g.8767823124" minlength="10" title="Only 10 digit Phone numbers are allowed" maxlength="10" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required />
        <p class="info">
          We support indian numbers only,(+91) country code.Enter phone number without the country code.<br>
          Your contact number will not be shared with external parties nor we
          will spam you in any way.It will be used by the buyer to contact you.
        </p>
      </div>
      <button class="submitBtn" type="submit">Create Account</button>
      <p class="terms-conditions">By clicking "Create Account" you agree to our <a href="#">Terms & Conditions</a> and have read our <a href="#">Privacy Policy</a>.</p>


    </form>

  </main>
  <footer>

    <p class="copyright">Copyright © 2022 BooksLelo. All rights reserved.</p>
  </footer>
</body>

</html>