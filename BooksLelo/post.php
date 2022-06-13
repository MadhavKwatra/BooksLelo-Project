<?php
session_start();
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

  <title>Post your Ad</title>
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
    <h1>Post your Ad</h1>
  </header>
  <main class="container">
    <?php
    // checking if user is logged In
    if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == "true") {
      echo '<form action="components/postHandle.php" method="POST" enctype="multipart/form-data">
      <div class="detailsGroup">
        <h3>Add some details about the book</h3>
        <div class="form-control">
          <label for="bookTitle">Book title</label><input type="text" id="bookTitle" placeholder="e.g. Atomic Habits" pattern="[a-zA-Z]{1,255}" maxlength=255 title="Only alphabets are allowed" name="bookTitle" required />
        </div>
        <div class="form-control">
          <label>Author</label><input type="text" name="author" placeholder="e.g. James Clear" pattern="[a-zA-Z]{1,255}" maxlength=255 title="Only alphabets are allowed" required />
        </div>
        <div class="form-control">
          <label for="semester-select">For Semester:</label>

          <select name="semester" id="semester-select" required>
            <option value="">--Select Semester--</option>
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
            <option value="5">Semester 5</option>
            <option value="6">Semester 6</option>
            <option value="0">Other</option>
          </select>
        </div>
        <div class="form-control">
          <label for="course-select">For Course:</label>

          <select name="course" id="course-select" required>
            <option value="">--Select Course--</option>
            <option value="bca">BCA</option>
            <option value="bca">MCA</option>
            <option value="msc">M.Sc</option>
            <option value="bvoc">B.Voc</option>
            <option value="bsc">B.Sc</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-control">
          <label for="bookDesc">Description</label>

          <textarea id="bookDesc" name="bookDesc" rows="5" minlength="20" placeholder="You can describe the books condition, why you want to sell it .This will help your ad become genuine. " required></textarea>
        </div>
      </div>
      <div class="priceGroup">
        <h3>Set a price</h3>
        <div class="form-control">
          <label>Price (INR)</label><input type="number" name="price" placeholder="100" min=0 max=1000 required />
        </div>
        <p class="info">Do not overprice your book.Price it according to its condition.Or you can give it for free by specifying its price 0.</p>
      </div>

      <div class="imageUploadGroup">
        <h3>Upload up to 6 photos</h3>
        <div class="form-control">
          <label>Upload Images</label><input name="images[]" type="file" multiple  required />
          
        </div>
        <div class="uploadedImages">
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
          <div class="imgContainer">
            <img src="images/camera.png" alt="" />
          </div>
        </div>
      </div>
      <div class="locGroup">
        <h3>Confirm your location</h3>
        <div class="form-control">
          <label for="city-select">Choose a City:</label>

          <select name="city" id="city-select" required>
            <option value="">--Please choose your city--</option>
            <option value="chandigarh">Chandigarh</option>
            <option value="zirakpur">Zirakpur</option>
            <option value="panchkula">Panchkula</option>
            <option value="mohali">Mohali</option>
          </select>
        </div>
        <!-- <div class="form-control">
          <label>Neigbourhood</label><input type="text" name="neigbourhood" />
        </div> -->
      </div>
      <input type="hidden" name="userId" value="' . $_SESSION["userId"] . '">
      <button class="postBtn" type="submit">Post</button>
    </form>';
    } else {
      echo '<h1>You need to be logged in to post an ad. <a href="/bookslelo/login.php">Click Here</a> to do so</h1>';
    }
    ?>

  </main>
  <footer>

    <p class="copyright">Copyright © 2022 BooksLelo. All rights reserved.</p>
  </footer>
</body>

</html>