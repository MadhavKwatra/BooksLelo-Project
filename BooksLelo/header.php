<?php
session_start();
echo '<header>
<a href="/bookslelo" class="logo">Books<span>Lelo</span> </a>

<!-- Navigation -->
<nav>
  <!-- Close icon -->
  <svg class="close" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
    <path fill="currentColor" d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm165.4 618.2l-66-.3L512 563.4l-99.3 118.4l-66.1.3c-4.4 0-8-3.5-8-8c0-1.9.7-3.7 1.9-5.2l130.1-155L340.5 359a8.32 8.32 0 0 1-1.9-5.2c0-4.4 3.6-8 8-8l66.1.3L512 464.6l99.3-118.4l66-.3c4.4 0 8 3.5 8 8c0 1.9-.7 3.7-1.9 5.2L553.5 514l130 155c1.2 1.5 1.9 3.3 1.9 5.2c0 4.4-3.6 8-8 8z" />
  </svg>';
// showing welcome username
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
  echo '<p class="greeting" style="position: absolute;
    font-size: 1.5rem;
    width: 50%;
    padding: 0.5em;
    top: 1em;"
  }>Hello <strong>' . $_SESSION['username'] . '</strong>!</p>';
}
echo '<ul>
    <li><a href="/bookslelo">Home</a></li>
    <li><a href="post.php">Post an Ad</a></li>
    ';
// showing logout and My ads button
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
  echo '<li><a href="/bookslelo/myAds.php">My Ads</a></li>
    <li><a href="components/logOutHandle.php">Log Out</a></li>';
} else {

  // else show login and signup
  echo '<li><a href="/bookslelo/logIn.php">Login</a></li>';
  echo '<li><a href="/bookslelo/signUp.php">Sign Up</a></li>';
}

echo '</ul>
</nav>

<!-- Menu Icon -->

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="menu">
  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
  <path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z" />
</svg>
</header>';
