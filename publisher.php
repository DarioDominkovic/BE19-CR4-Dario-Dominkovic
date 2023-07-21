<?php
require_once "db_connect.php";

if (isset($_GET['publisher_name'])) {
    $publisher_name = $_GET['publisher_name'];

    // Fetch all media published by the specific publisher
    $sql = "SELECT * FROM media WHERE publisher_name = '$publisher_name'";
    $result = mysqli_query($connect, $sql);
    $media_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Publisher name not provided.";
    exit();
}
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

    .card {
        background-color: #fbd17d;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        width: 300px;
    }

    .card-img-container {
        height: 400px;
    }

    .card-img-top {
        max-height: 100%;
    }

    .back {
        display: flex;
        justify-content: center;
        padding: 20px;
        margin: 50px 0px;
    }

    .details-button-container {
        position: relative;
        /* To position the button within the container */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;

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
</style>

<body>
    <h1 class="mb-4">Published by <?= $publisher_name ?></h1>
    <div class="container mt-5">
        <?php if (count($media_list) > 0) : ?>
            <div class="row">
                <?php foreach ($media_list as $media) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <?php
                            if (!empty($media['image'])) {
                                if (filter_var($media['image'], FILTER_VALIDATE_URL)) {
                                    echo '<img src="' . $media['image'] . '" class="card-img-top" alt="' . $media['title'] . '">';
                                } else {
                                    echo '<img src="images/' . $media['image'] . '" class="card-img-top" alt="' . $media['title'] . '">';
                                }
                            } else {
                                echo '<img src="default-image.jpg" class="card-img-top" alt="' . $media['title'] . '">';
                            }
                            ?>

                            <h4 class="card-title position-absolute bottom-0 start-0 mb-2 mx-2" style="color: white; font-size: 25px;"><?php echo $media['title']; ?></h4>
                            <div class="buttons d-flex justify-content-center">
                                <a href="details.php?mediaID=<?php echo $media['mediaID']; ?>" class="btn btn-success">Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php else : ?>
            <p>No media found for <?= $publisher_name ?></p>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary back"> Back all Book </a>
    </div>
</body>

</html>