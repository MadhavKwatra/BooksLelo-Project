<?php
require "components/connectingToDB.php";
?>
<?php
if (isset($_GET['u_id'])) {
  $userId = $_GET['u_id'];
  $sql = "SELECT * FROM `users` WHERE `u_id`=$userId ";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);

  while ($row = mysqli_fetch_assoc($result)) {
    $name = ucwords($row['u_fname'] . " " . $row['u_lname']);
    $totalAds = $row['u_total_ads'];
    $username = $row['u_username'];
    $u_accountCreatedTime = $row['u_timestamp'];
  }
} else {
  //redirect to homepage
  header("Location:/bookslelo-project/bookslelo");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $name; ?> - BooksLelo</title>
  <!-- Google Font - Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/main.css" />
  <style>
    header {
      display: flex;
      justify-content: flex-start;
    }

    header h1 {
      margin-top: 0;
      font-size: 2rem;
    }

    svg.back {
      width: 1.5rem;
      margin: 0.3rem;
      margin-right: 1em;
    }

    .user-info img {
      width: 100%;
      padding: 4em;
    }

    .user-info {
      text-align: center;
      padding: 1em;
    }

    .ads h2 {
      text-align: center;
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
    <h1>Profile</h1>
  </header>
  <section class="user-info">

    <img src="images/user.png" alt="blank user image" />
    <h2 class="name"><?php echo $name; ?></h2>
    <p class="username">@<?php echo $username; ?></p>
    <div class="ads-posted">
      <span><b>Total Ads</b></span>
      <span><?php echo $totalAds; ?></span>
    </div>
    <p><b>Member Since</b> <?php echo date("F j, Y", strtotime($u_accountCreatedTime)) ?></p>
  </section>
  <section class="ads">
    <hr>
    <h2>Ads posted</h2>
    <?php
    // fetching books posted by this user
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
    <a  href="item.php?id=' . $b_id . '">View More</a>
  </div>';
    }
    if ($noBooks) {
      echo '<h1>The user don\'t have any ads posted.</h1>';
    }

    ?>

  </section>
</body>

</html>