<?php
session_start();
$username = $_SESSION["username"];

header("Location: /bookslelo?loggedOut=true&user=$username");
//<a href="/bookslelo">Click Here </a>
session_destroy();
