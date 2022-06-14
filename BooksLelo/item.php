<?php
require "components/connectingToDB.php";
?>
<?php
$b_id = $_GET['id'];
$sql = "SELECT * FROM `books` WHERE `b_id`=$b_id ";

$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
  $bTitle = $row['b_title'];
  $bDesc = $row['b_desc'];
  $bookPhotosString = $row['b_photos'];
  $bPrice = $row['b_price'];
  $bCity = $row['b_city'];
  $b_postedTime = $row['b_timestamp'];


  $bookPhotosArray = explode(" ", $bookPhotosString);

  // getting which user posted the ad
  $adPostedByUserId = $row['u_id'];
  $sql = "SELECT * FROM `users` WHERE `u_id`='$adPostedByUserId' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $adPostedByUserName = $row['u_username'];
  $sellersPhone = $row['u_phone'];
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
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/item.css" />
  <title>The Da Vinci Code</title>
</head>

<body>
  <div class="wrapper">
    <?php
    require 'header.php';
    ?>

    <main>
      <section class="product">
        <div class="slides-container">
          <!-- Left Arrow Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="arrow-left" viewBox="0 0 16 16">
            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
          </svg>

          <?php
          foreach ($bookPhotosArray as $bookPhoto) {

            echo '<div class="slide">
            <img src="uploads/' . $bookPhoto . '" alt="" />
          </div>';
          }
          ?>
          <p class="current-image-text"></p>
          <!-- Right Arrow icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" id="arrow-right" viewBox="0 0 16 16">
            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
          </svg>
        </div>
        <div class="product-info">
          <h1>₹<?php echo $bPrice; ?></h1>
          <p class="views">10 views</p>
          <p class="title">
            <?php echo $bTitle; ?>
          </p>

          <hr />
          <div class="posted-on">
            <?php
            echo '<span>' . ucfirst($bCity) . '</span><span>' . date("F j", strtotime($b_postedTime)) . '</span>';
            ?>

          </div>
          <div class="description">
            <h2>Description</h1>
              <p class="desc"><?php echo $bDesc; ?>
              </p>
          </div>
          <div class="seller-info">
            <h2>Posted By</h2><?php
                              echo '<a href="profile.php?u_id=' . $adPostedByUserId . '"> ' . $adPostedByUserName . '</a>'; ?>
          </div>
        </div>
        <div class="contact">

          <h2>Contact the Seller</h2>
          <?php
          if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {
            echo '<p>Contact No. ' . $sellersPhone . '</p>';
            echo '<button>
              <a href="https://wa.me/+91' . $sellersPhone . '">Chat on <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="whatsapp-icon" viewBox="0 0 16 16">
              <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                        </svg></a>
            </button>';
          } else {

            echo '<h3>You need to be logged in to view the seller\'s contact info. <a href="/bookslelo-project/bookslelo/login.php">Click Here</a> to do so</h3>';
          }
          ?>
        </div>
      </section>
    </main>
  </div>
  <footer>
    <p class="copyright">Copyright © 2022 BooksLelo. All rights reserved.</p>
  </footer>
  <script src="js/script.js"></script>
  <script>
    // Image Slider
    const currentImage = document.querySelector(".current-image-text");
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      showSlides((slideIndex += n));
    }

    // click listener for arrows to change images in slide container

    document.querySelector("#arrow-right").addEventListener("click", () => {
      plusSlides(1);
    });

    document.querySelector("#arrow-left").addEventListener("click", () => {
      plusSlides(-1);
    });

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("slide");
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
      currentImage.innerHTML = `${slideIndex}/${slides.length}`;
    }
  </script>
</body>

</html>