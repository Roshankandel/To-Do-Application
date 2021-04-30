<?php
include "dbconn.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (empty($id)) {
        header("location:index.php?mess=error");
    } else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
        $stmt->bind_param("i", $id);

        // set parameters and execute
        $id = $id;
        $stmt->execute();
        header("location:index.php");
    }
}
