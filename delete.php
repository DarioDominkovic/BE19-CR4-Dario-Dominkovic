<?php

require_once "db_connect.php";

$id = $_GET["mediaID"];

$sql = "DELETE FROM media WHERE mediaID = $id";
if (mysqli_query($connect, $sql)) {
    header("location: index.php");
} else {
    echo "ERROR";
}
