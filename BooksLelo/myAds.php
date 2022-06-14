<?php
require 'components/ConnectingToDB.php';
session_start();
$isAdDeleted = false;
?>
<?php

//deleting the ad
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true" && isset($_GET["delete"])) {
  $bookId = $_GET["delete"];
  $sql = "DELETE FROM `books` WHERE `b_id` = $bookId;";
  $result = mysqli_query($conn, $sql);
  $msg = "Deleted Successfully";
  $isAdDeleted = true;
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Ads</title>
  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css" />
  <style>
    section.ads {
      padding: 1em;
    }

    a {
      font-size: 2rem;
    }



    .card {
      position: relative;
    }

    button.delete {
      position: absolute;
      top: 0;
      right: 0;
      margin: 1em;
      padding: 1em;
      border-radius: 1em;
      border: 1px solid #000;
    }

    .delete svg {
      width: 3rem;
    }

    header {
      display: flex;
      justify-content: flex-start;
    }

    header h1 {
      margin-top: 0;
    }

    svg.back {
      width: 1.5rem;
      margin-right: 1em;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <header>
    <!-- Back Icon -->
    <a href="/bookslelo-project/bookslelo">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="back">
        <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com div class="form-control"cense - https://fontawesome.com/div class="form-control"cense (Commercial div class="form-control"cense) Copyright 2022 Fonticons, Inc. -->
        <path d="M447.1 256C447.1 273.7 433.7 288 416 288H109.3l105.4 105.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L109.3 224H416C433.7 224 447.1 238.3 447.1 256z" />
      </svg>
    </a>
    <h1>My Ads</h1>
  </header>
  <main class="container">
    <section class="ads">

      <?php

      if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {

        $userId = $_SESSION["userId"];

        // fetching books posted by the logged in user
        $sql = "SELECT * FROM `books` WHERE `u_id`= $userId";
        $result = mysqli_query($conn, $sql);

        $noBooks = true;
        while ($row = mysqli_fetch_assoc($result)) {
          $noBooks = false;
          $b_price = $row['b_price'];
          $b_id = $row['b_id'];
          $bookTitle = $row['b_title'];
          $bookCity = $row['b_city'];
          $b_postedTime = $row['b_timestamp'];
          $bookPhotosString = $row['b_photos'];
          $bookPhotosArray = explode(" ", $bookPhotosString);

          echo '<div class="card">
      <img src="uploads/' . $bookPhotosArray[0] . '" alt="book" class="card_image" />
      <div class="card_heading">
        <h1>₹' . $b_price . '</h1>
        <p class="desc">' . $bookTitle . '</p>
      </div>
      <div class="card_bottom">
        <span>' . ucfirst($bookCity) . '</span><span>' . date("F j Y", strtotime($b_postedTime)) . '</span>
      </div>
      <button type="button" class="delete" id="d' . $b_id . '"><!-- delete icon -->
          <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" viewBox="0 0 16 16">
          <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
          </svg></button>
    </div>';
        }
        if ($noBooks) {
          echo '<h1>You don\'t have any ads posted. Post some ad if you want .<a href="/bookslelo-project/bookslelo/post.php">Click Here</a> to do so</h1>';
        }
      } else {
        echo '<h1>You need to be logged in to view your ads . <a href="/bookslelo-project/bookslelo/login.php">Click Here</a> to do so</h1>';
      }
      ?>

    </section>

  </main>

  <script>
    deletes = document.querySelectorAll('.delete');
    // converting deletes to real array using Array.from()
    Array.from(deletes).forEach((member) => {
      member.addEventListener("click", (e) => {
        // console.log("edit ", );

        // storing bookId of value to be deleted
        bookId = e.target.id.substr(1, );
        // it removes 1 starting character


        // confirmation
        if (confirm("Are you Sure you want to Delete This Ad? People won't be able to see this ad on the search then.")) {
          // console.log("Yes");
          window.location = `/bookslelo-project/bookslelo/myAds.php?delete=${bookId}`;
          // TODO : create form and use post for security
        } else {
          console.log("No");
        }

      })
    })
  </script>
</body>

</html>