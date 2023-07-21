<?php

require_once "db_connect.php";

$sql = "SELECT * FROM media";
$result = mysqli_query($connect, $sql);

$sql_publishers = "SELECT DISTINCT publisher_name FROM media";
$result_publishers = mysqli_query($connect, $sql_publishers);
$publishers = mysqli_fetch_all($result_publishers, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon link -->
    <link rel="icon" type="image/png" href="images/favicon-book.png">

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Big Library</title>
</head>
<style>
    body {
        font-family: sans-serif;
        background-color: #3d8865;
    }

    h1 {
        padding: 15px;
        background-color: #fbd17d;
        display: flex;
        justify-content: center;
    }

    h4 {
        color: white;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .main {
        padding: 20px;
    }

    .main img {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .card-img-top {
        height: 400px;
        object-fit: cover;
    }

    .center-screen {
        height: 10vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 10%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .card {
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0);
        z-index: 1;
        transition: background-color 0.3s ease;
    }

    .card:hover::before {
        background-color: rgba(0, 0, 0, 0.4);
    }

    .card .buttons {
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform: translate(-50%, 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }

    .card:hover .buttons {
        opacity: 1;
    }

    .publisher {
        margin: 100px;
        padding: 10px;
        background-color: #fbd17d;
        border-radius: 5px;
        text-align: center;
        width: 200px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .publisher a {
        color: #3d8865;
        text-decoration: none;
        font-weight: bold;
        font-size: 18px;
    }

    .publisher a:hover {
        color: #fff;
        background-color: #3d8865;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }
</style>
</head>

<body>
    <h1>Book Library</h1>

    <div class="main d-flex justify-content-center align-items-center">
        <img src="https://cdn.pixabay.com/photo/2015/07/31/11/45/library-869061_1280.jpg" alt="" class="img-fluid">
    </div>

    <h1>Books</h1>

    <div class="container">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-4 mb-4">

                        <div class="card h-100">
                            <?php
                            if (!empty($row['image'])) {
                                if (filter_var($row['image'], FILTER_VALIDATE_URL)) {
                                    echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                                } else {
                                    echo '<img src="images/' . $row['image'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                                }
                            } else {
                                echo '<img src="default-image.jpg" class="card-img-top" alt="' . $row['title'] . '">';
                            }
                            ?>

                            <h4 class="card-title position-absolute bottom-0 start-0 mb-2 mx-2" style="color: white; font-size: 25px;"><?php echo $row['title']; ?></h4>
                            <div class="buttons d-flex justify-content-center">
                                <a href="details.php?mediaID=<?php echo $row['mediaID']; ?>" class="btn btn-success">Details</a>
                                <a href="update.php?mediaID=<?php echo $row['mediaID']; ?>" class="btn btn-primary ms-2">Edit</a>
                                <a href="delete.php?mediaID=<?php echo $row['mediaID']; ?>" class="btn btn-danger ms-2">Delete</a>
                            </div>
                        </div>

                    </div>
            <?php
                }
            } else {
                echo '<div class="col"><p>Media not found.</p></div>';
            }
            ?>
        </div>
    </div>

    <div class="container center-screen">
        <a href="create.php" class="btn btn-primary"> ADD MORE BOOKS </a>
    </div>

    <h1>Publisher</h1>

    <div class="container d-flex justify-content-center my-5">
        <div class="row">
            <?php foreach ($publishers as $publisher) : ?>
                <div class="col-md-4 mb-4">
                    <a href="publisher.php?publisher_name=<?= urlencode($publisher['publisher_name']) ?>" class="publisher">
                        <?= $publisher['publisher_name'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>