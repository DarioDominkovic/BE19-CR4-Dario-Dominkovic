<?php

require_once "db_connect.php";

$id = $_GET["mediaID"];

$id = filter_var($id, FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    echo "Invalid book ID.";
    exit;
}

$sql = "SELECT * FROM media WHERE mediaID = $id";
$result = mysqli_query($connect, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Book not found.";
    exit;
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($connect, $_POST['name']);
    $isbn = mysqli_real_escape_string($connect, $_POST['isbn']);
    $image = mysqli_real_escape_string($connect, $_POST['image']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $author_name = mysqli_real_escape_string($connect, $_POST['author_name']);
    $publisher_name = mysqli_real_escape_string($connect, $_POST['publisher_name']);
    $publish_date = mysqli_real_escape_string($connect, $_POST['publish_date']);
    $status = mysqli_real_escape_string($connect, $_POST['status']);

    $updateSql = "UPDATE media SET `title`='$title', `isbn_code`='$isbn', `image`='$image', `description`='$description', `author_name`='$author_name', `publisher_name`='$publisher_name', `publish_date`='$publish_date' ,`status`='$status' WHERE mediaID=$id";

    if (mysqli_query($connect, $updateSql)) {

        header("refresh: 1; url=index.php");
        exit;
    } else {
        echo "ERROR !!! Something went wrong";
    }
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
    * {
        box-sizing: border-box;
    }

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

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fbd17d;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-group input[type="submit"] {
        padding: 10px 20px;
        background-color: #3498db;
        border: none;
        color: #ffffff;
        border-radius: 4px;
        font-size: 18px;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #2980b9;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        display: none;
    }

    .loading-spinner {
        border: 4px solid rgba(0, 0, 0, 0.3);
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    #description {
        height: 150px;
        width: 100%;
        resize: vertical;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
</head>

<body>
    <h1>Update Book</h1>
    <div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Book Title:</label>
                <input type="text" id="name" name="name" value="<?= htmlentities($row["title"]) ?>">
            </div>
            <div class="form-group">
                <label for="image">Image Name or URL:</label>
                <input type="text" id="image" name="image" value="<?= htmlentities($row["image"]) ?>">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN Code:</label>
                <input type="text" id="isbn" name="isbn" value="<?= htmlentities($row["isbn_code"]) ?>">
            </div>
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="text" id="author_name" name="author_name" value="<?= htmlentities($row["author_name"]) ?>">
            </div>
            <div class="form-group">
                <label for="publisher_name">Publisher Name:</label>
                <input type="text" id="publisher_name" name="publisher_name" value="<?= htmlentities($row["publisher_name"]) ?>">
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date:</label>
                <input type="date" id="publish_date" name="publish_date" value="<?= htmlentities($row["publish_date"]) ?>">
            </div>
            <div class="form-group">
                <label for="description">Book Description:</label>
                <textarea id="description" name="description"><?= htmlentities($row["description"]) ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="available" <?php if ($row['status'] === 'available') echo 'selected'; ?>>available</option>
                    <option value="reserved" <?php if ($row['status'] === 'reserved') echo 'selected'; ?>>reserved</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="update" value="Update Book">
            </div>
        </form>
    </div>

    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <script src="/js/script.js"></script>
</body>

</html>