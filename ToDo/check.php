<?php

include "dbconn.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (empty($id)) {
        echo 'error';
    } else {
        // $stmt = $conn->prepare("SELECT id,checked FROM todos WHERE id=?");
        //$stmt->execute([$id]);
        //$row = $stmt->fetch();
        $result = $conn->query("SELECT id,checked FROM todos WHERE id=$id");
        $row = $result->fetch_assoc();
        $uid = $row['id'];
        $checked = $row['checked'];
        $uchecked = $checked ? 0 : 1;
        $result = $conn->query(" UPDATE todos SET checked = $uchecked WHERE id=$uid");
        if ($result) {
            echo $checked;
        } else {
            echo 'error';
        }
        $conn->close();
        exit();
    }
} else {
    header("location:index.php?mess=error");
}
