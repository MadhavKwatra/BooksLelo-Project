<?php
require 'components/ConnectingToDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for "<?php
                                $search_query = $_GET['q'];
                                echo $search_query;
                                ?>" - maDiscuss </title>
    <!-- Google Font - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/main.css" />
    <style>
        h1,
        h2 {
            font-weight: 500;
        }

        p:first-of-type {
            font-weight: 400;
            font-size: 1.5rem;
        }

        p:last-child {
            font-weight: 300;
            font-size: 1.2rem;
        }



        img {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1em;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php
        require 'header.php'; ?>
        <!-- Search Results -->

        <main>
            <section class="products">



                <!-- getting search Results from books table  -->
                <?php

                //fetching matched results from db
                $sql = "SELECT * FROM books WHERE MATCH(b_title) AGAINST('$search_query')";
                $result = mysqli_query($conn, $sql);
                $noOfResults = mysqli_num_rows($result);
                if (!$noOfResults > 0) {
                    echo '<p>Oops... we didn\'t find anything that matches your search "' . $search_query . '"</p>
                        <p>Try searching for something more general, check for spelling mistakes.</p><img src="images/noResults.png" alt="no results image">
                        <div class="search-bar">
        <form action="search.php" method="GET">
          <input type="text" name="q" id="search-bar" placeholder="Search your favourite Books" /><button type="submit">
          Search
            <i class="fa fa-search">
            Search
              <!-- used font awesome icon search -->
            </i>
          </button>
        </form>
      </div>
                        ';
                } else {

                    // Search bar
                    echo '<div class="search-bar">
                    <form action="search.php" method="GET">
                        <input type="text" name="q" id="search-bar" placeholder="Search your favourite Books" />
                    </form>
                </div>';
                    echo '<h1>' . $noOfResults . ' results found for "<em>' . $search_query . '</em>"</h1>';
                    while ($row = mysqli_fetch_assoc($result)) {

                        $b_id = $row['b_id'];
                        $b_price = $row['b_price'];
                        $bookTitle = $row['b_title'];
                        $bookCity = $row['b_city'];
                        $b_postedTime = $row['b_timestamp'];
                        $bookPhotosString = $row['b_photos'];
                        $bookPhotosArray = explode(" ", $bookPhotosString);

                        // displaying the results
                        echo '<div class="card">
                            <img src="uploads/' . $bookPhotosArray[0] . '" alt="book"     class="card_image" />
                            <div class="card_heading">
                            <h1>₹' . $b_price . '</h1>
                            <p class="desc">' . $bookTitle . '</p>
                            </div>
                            <div class="card_bottom">
                            <span>' . ucfirst($bookCity) . '</span><span>' . date("F j",    strtotime($b_postedTime)) . '</span>

                                </div>
                                <a href="item.php?id=' . $b_id . '">View More</a>
                            </div>';
                    }
                }
                ?>
            </section>
        </main>

    </div>
    <script src="js/script.js"></script>

</body>

</html>