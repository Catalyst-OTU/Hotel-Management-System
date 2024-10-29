<?php

include '../config.php';

$id = $_GET['id'];

$deletesql = "DELETE FROM staff WHERE id = $id";

$result = mysqli_query($conn, $deletesql);

header("Location:staffs.php");

?>