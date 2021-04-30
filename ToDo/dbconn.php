<?php
$conn = mysqli_connect("localhost", "root", "", "to_do_list");
if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
