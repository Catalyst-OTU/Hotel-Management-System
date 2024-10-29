<?php

include '../config.php';

$id = $_GET['id'];

$deletesql = "DELETE FROM room WHERE id = $id";

$result = mysqli_query($conn, $deletesql);

header("Location:rooms.php");

?>