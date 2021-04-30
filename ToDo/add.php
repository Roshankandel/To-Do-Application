<?php
include "dbconn.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    if (empty($title)) {
        header("location:index.php?mess=error");
    } else {
        $stmt = $conn->prepare("INSERT INTO todos (title) VALUES (?)");
        $stmt->bind_param("s", $title);

        // set parameters and execute
        $title = $title;
        $stmt->execute();
        header("location:index.php");
    }
}
