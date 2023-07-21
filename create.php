<?php

require_once "db_connect.php";

if (isset($_POST['create'])) {
    $title = $_POST['name'];
    $isbn = $_POST['isbn'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $author_name = $_POST['author_name'];
    $publisher_name = $_POST['publisher_name'];
    $publish_date = $_POST['publish_date'];
    $status = $_POST['status'];


    $sql = "INSERT INTO media (title, isbn_code, image, description, author_name, publisher_name, publish_date, status) VALUES ('$title', '$isbn', '$image', '$description', '$author_name', '$publisher_name', '$publish_date', '$status')";

    if (mysqli_query($connect, $sql)) {
        header("refresh: 1; url = index.php");
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

<body>
    <h1>Create Book</h1>
    <div class="container">
        <form method="post" action="">
            <!-- The form elements for creating a new book -->
            <div class="form-group">
                <label for="name">Book Title:</label>
                <input type="text" id="name" name="name" value="">
            </div>
            <div class="form-group">
                <label for="image">Image Name or URL:</label>
                <input type="text" id="image" name="image" value="">
            </div>
            <div class="form-group">
                <label for="isbn">ISBN Code:</label>
                <input type="text" id="isbn" name="isbn" value="">
            </div>
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="text" id="author_name" name="author_name" value="">
            </div>
            <div class="form-group">
                <label for="publisher_name">Publisher Name:</label>
                <input type="text" id="publisher_name" name="publisher_name" value="">
            </div>
            <div class="form-group">
                <label for="publish_date">Publish Date:</label>
                <input type="date" id="publish_date" name="publish_date" value="">
            </div>
            <div class="form-group">
                <label for="description">Book Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="available">available</option>
                    <option value="reserved">reserved</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="create" value="CREATE BOOK">
            </div>
        </form>
    </div>

    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <script src="/js/script.js"></script>
</body>

</html>