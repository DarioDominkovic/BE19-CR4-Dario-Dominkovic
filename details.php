<?php
require_once "db_connect.php";

if (isset($_GET['mediaID'])) {
    $mediaID = $_GET['mediaID'];
    $sql = "SELECT * FROM media WHERE mediaID = $mediaID";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Media not found.";
        exit;
    }
} else {
    echo "Invalid mediaID.";
    exit;
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

    h2 {
        display: flex;
        justify-content: center;
    }

    .container {
        padding: 30px;
    }

    #info {
        background-color: #fbd17d;
        border-radius: 10px;
    }

    .btn {
        display: flex;
        justify-content: center;
        margin: 0 100px;
    }

    .text-danger {
        font-weight: bolder;
        color: red;
    }

    .text-success {
        font-weight: bolder;
        color: green;
    }
</style>

<body>
    <h1>Book Details</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php
                if (filter_var($row['image'], FILTER_VALIDATE_URL)) {
                    echo '<img src="' . $row['image'] . '" class="img-fluid" alt="' . $row['title'] . '">';
                } else {
                    echo '<img src="images/' . $row['image'] . '" class="img-fluid" alt="' . $row['title'] . '">';
                }
                ?>
            </div>
            <div class="col-md-8" id="info">
                <h2><?php echo $row['title']; ?></h2>
                <p><strong>ISBN:</strong> <?php echo $row['isbn_code']; ?></p>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                <p><strong>Author:</strong> <?php echo $row['author_name']; ?></p>
                <p><strong>Publisher:</strong> <?php echo $row['publisher_name']; ?></p>
                <p><strong>Publish Date:</strong> <?php echo $row['publish_date']; ?></p>
                <p><strong>Status:</strong> <span class="<?php echo ($row['status'] === 'reserved') ? 'text-danger' : 'text-success'; ?>"><?php echo $row['status']; ?></span></p>
                <a href="index.php" class="btn btn-primary">Go Back</a>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>