<?php
require 'components/ConnectingToDB.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

  <!-- font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="css/main.css" />
  <style>
    .alert-message p {
      background-color: lightsalmon;
      padding: 0.5em;
      font-size: 1.5rem;
    }
  </style>
</head>

<body>
  <div class="hero-img"></div>
  <div class="wrapper">
    <?php
    require 'header.php';
    ?>
    <!-- alert to show messages -->
    <div class="alert-message">

      <?php
      //Log Out message
      if (isset($_GET["loggedOut"]) && $_GET["loggedOut"] == "true" && isset($_GET["user"])) {
        echo "<p>Logged out successfully.Have a nice day!<b> @" . $_GET['user'] . "</b></p>";
      }
      //logged in message
      if (isset($_GET["loggedIn"]) && $_GET["loggedIn"] == "true") {
        echo "<p>Welcome to Bookslelo. <b>" . $_GET["user"] . "</b>!</p>";
      }

      //username exists and password incorrect message
      if (isset($_GET["loggedIn"]) && $_GET["loggedIn"] == "false" && isset($_GET["user"])) {
        echo "<p>$username your password is incorrect. Try Again!</p>";
      }

      //username doesn't exist
      if (isset($_GET["loggedIn"]) && $_GET["loggedIn"] == "false") {
        echo "<p>Username doesn't exist.<a href=\"/bookslelo-project/bookslelo/signUp.php\">Click here</a> to create a new account</p>";
      }

      //ad posted 
      if (isset($_GET["adPosted"]) && $_GET["adPosted"] == "true") {
        echo "<p>The ad posted successfully. Now sit back and relax. The buyer will contact you soon. Have a Nice Day!</p>";
      }
      //ad posted 
      if (isset($_GET["accountCreated"]) && $_GET["accountCreated"] == "true") {
        echo "<p>Account created successfully . Now You can login.!</p>";
      }


      ?>

    </div>
    <section class="hero">
      <h1>Sell your used Textbooks near you</h1>
      <p class="subhead">
        Do you have textbooks lying around your house doing nothing? Then, you've come to the right place!
      </p>
      <div class="search-bar">
        <form action="search.php" method="GET">
          <input type="text" name="q" id="search-bar" placeholder="Search your favourite Books" />
        </form>
      </div>
    </section>
    <main>
      <!-- Fetching books from DB and echoing code -->


      <h1>Recently added</h1>
      <section class="products">
        <?php
        $sql = "SELECT * FROM `books` ORDER BY `b_id` DESC  LIMIT 5";
        $result = mysqli_query($conn, $sql);

        $noBooks = true;
        while ($row = mysqli_fetch_assoc($result)) {
          $noBooks = false;
          $b_id = $row['b_id'];
          $b_price = $row['b_price'];
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
            <span>' . ucfirst($bookCity) . '</span><span>' . date("F j", strtotime($b_postedTime)) . '</span>
            
          </div>
          <a  href="item.php?id=' . $b_id . '">View More</a>
        </div>';
        }
        if ($noBooks) {
          echo '<h1>There are no ads available right now.<a style="font-size: inherit;" href="/bookslelo-project/bookslelo/post.php">Click Here</a> to post an ad.</h1>';
        }
        ?>
      </section>
    </main>
  </div>
  <footer>
    <p class="copyright">Copyright © 2022 BooksLelo. All rights reserved.</p>
  </footer>
  <script src="js/script.js"></script>
</body>

</html>