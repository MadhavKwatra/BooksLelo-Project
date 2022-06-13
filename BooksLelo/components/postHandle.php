<?php

$msg = "";
$imagesDb = array();
$uploadSuccess = false;

require 'ConnectingToDB.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // getting submitted data
    $b_title = $_POST['bookTitle'];
    $b_author = $_POST['author'];
    $b_sem = $_POST['semester'];
    $b_course = $_POST['course'];
    $b_desc = $_POST['bookDesc'];
    $b_price = $_POST['price'];
    $b_city = $_POST['city'];
    $postedByUserId = $_POST['userId'];
    // Uploading images
    $upload_dir = '../uploads' . DIRECTORY_SEPARATOR;
    $allowed_types = array('jpg', 'png', 'jpeg');


    // Max file size is 2 MB
    $maxsize = 2 * 1024 * 1024;
    // checking if files are there
    if (!empty(array_filter($_FILES['images']['name']))) {
        $imagesArray = $_FILES['images'];

        // loop through each image in array
        foreach ($imagesArray['tmp_name'] as $key => $value) {
            $file_name = $imagesArray['name'][$key];
            $fileTempName = $imagesArray['tmp_name'][$key];
            $fileSize = $imagesArray['size'][$key];
            $fileExt = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $newFileName = round(microtime(true)) . "$key." . $fileExt;
            array_push($imagesDb, $newFileName);

            // upload file path
            $filepath = $upload_dir . $newFileName;

            // Check file type is allowed or not
            if (in_array($fileExt, $allowed_types)) {
                if ($fileSize < $maxsize) {
                    if (move_uploaded_file($fileTempName, $filepath)) {
                        $msg = "Photos successfully Uploaded";
                        //echo "{$file_name} successfully uploaded <br />";
                    } else {
                        echo "Error uploading {$file_name} <br />";
                    }

                    $uploadSuccess = true;
                } else {
                    $msg = "Error uploading.";
                    $msg .= " Size is higher than 2MB";
                }
            } else {
                // If file extension not valid
                $msg = "Error uploading {$file_name} ";
                $msg .= " ({$fileExt} file type is not allowed)<br / >";
            }
        }
    } else {
        $msg = "No Files Selected";
    }

    if ($uploadSuccess) {
        // setting up the imageNames for inserting into database 
        $imagesName = implode(" ", $imagesDb);

        // inserting book into Books Table
        $sql = "INSERT INTO `books` (`b_title`, `b_author`, `b_sem`, `b_course`, `b_desc`, `b_photos`, `b_price`, `b_city`, `b_timestamp`, `u_id`) VALUES ('$b_title', '$b_author', '$b_sem', '$b_course', '$b_desc', '$imagesName', '$b_price', '$b_city', current_timestamp(), '$postedByUserId');";

        // Execute query
        $result = mysqli_query($conn, $sql);
        if ($result) {
            //incrementing total ads of the user who posted this ad
            $sql = "SELECT * FROM `users` WHERE `u_id`=$postedByUserId";
            $result1 = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result1);
            $totalAds = $row['u_total_ads'] + 1;
            $sql = "UPDATE `users` SET `u_total_ads` = '$totalAds' WHERE `u_id` = $postedByUserId";
            $result1 = mysqli_query($conn, $sql);

            //echo "Inserted Successfully";
            header("Location: /bookslelo?adPosted=true");
        } else {

            echo "error : " . mysqli_error($conn);
        }
    } else {

        echo "<h1>";
        echo $msg;
        echo '<br><a href="/bookslelo/post.php">Try again</a>';
        echo "</h1>";
    }
}
