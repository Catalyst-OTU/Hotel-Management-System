<?php

include '../config.php';
 


if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $date_employed = $_POST['date_employed'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    #$sql = "INSERT INTO staff(name, role, date_employed, phone, email, address, password) VALUES ('$name', '$role', '$date_employed', '$phone', '$email, '$address', '$password')";
    $sql2 = "INSERT INTO `staff` (`name`, `role`, `date_employed`, `phone`, `email`, `gender`, `address`, `password`) VALUES
            ('$name', '$role', '$date_employed', '$phone', '$email', '$gender', '$address', '$password');";
    $result = mysqli_query($conn, $sql2);

    if ($result) {
        header("Location: staffs.php");
    }
    else{
        header("Location: somethingwentwrong.php");
        echo "STAFF NOT REGISTER";
    }
}
?>
