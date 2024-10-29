<?php

include '../config.php';

// fetch room data
$id = $_GET['id'];

$sql ="Select * from staff where id = '$id'";
$re = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($re))
{
    $name = $row['name'];
    $phone = $row['phone'];
    $gender = $row['gender'];
    $address = $row['address'];
    $date_employed = $row['date_employed'];
    $email = $row['email'];
    $role = $row['role'];
    $password = $row['password'];
}

if (isset($_POST['guestdetailedit'])) {
    $EditName = $_POST['Name'];
    $EditEmail = $_POST['Email'];
    $EditCountry = $_POST['Country'];
    $EditPhone = $_POST['Phone'];
    $EditRoomType = $_POST['RoomType'];
    $EditBed = $_POST['Bed'];
    $EditNoofRoom = $_POST['NoofRoom'];
    $EditMeal = $_POST['Meal'];
    $Editcin = $_POST['cin'];
    $Editcout = $_POST['cout'];

    $sql = "UPDATE roombook SET Name = '$EditName',Email = '$EditEmail',Country='$EditCountry',Phone='$EditPhone',RoomType='$EditRoomType',Bed='$EditBed',NoofRoom='$EditNoofRoom',Meal='$EditMeal',cin='$Editcin',cout='$Editcout',nodays = datediff('$Editcout','$Editcin') WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    $type_of_room = 0;
    if($EditRoomType=="Superior Room")
    {
        $type_of_room = 3000;
    }
    else if($EditRoomType=="Deluxe Room")
    {
        $type_of_room = 2000;
    }
    else if($EditRoomType=="Guest House")
    {
        $type_of_room = 1500;
    }
    else if($EditRoomType=="Single Room")
    {
        $type_of_room = 1000;
    }
    
    
    if($EditBed=="Single")
    {
        $type_of_bed = $type_of_room * 1/100;
    }
    else if($EditBed=="Double")
    {
        $type_of_bed = $type_of_room * 2/100;
    }
    else if($EditBed=="Triple")
    {
        $type_of_bed = $type_of_room * 3/100;
    }
    else if($EditBed=="Quad")
    {
        $type_of_bed = $type_of_room * 4/100;
    }
    else if($EditBed=="None")
    {
        $type_of_bed = $type_of_room * 0/100;
    }

    if($EditMeal=="Room only")
    {
        $type_of_meal=$type_of_bed * 0;
    }
    else if($EditMeal=="Breakfast")
    {
        $type_of_meal=$type_of_bed * 2;
    }
    else if($EditMeal=="Half Board")
    {
        $type_of_meal=$type_of_bed * 3;
    }
    else if($EditMeal=="Full Board")
    {
        $type_of_meal=$type_of_bed * 4;
    }
    
    // noofday update
    $psql ="Select * from roombook where id = '$id'";
    $presult = mysqli_query($conn,$psql);
    $prow=mysqli_fetch_array($presult);
    $Editnoofday = $prow['nodays'];

    $editttot = $type_of_room*$Editnoofday * $EditNoofRoom;
    $editmepr = $type_of_meal*$Editnoofday;
    $editbtot = $type_of_bed*$Editnoofday;

    $editfintot = $editttot + $editmepr + $editbtot;

    $psql = "UPDATE payment SET Name = '$EditName',Email = '$EditEmail',RoomType='$EditRoomType',Bed='$EditBed',NoofRoom='$EditNoofRoom',Meal='$EditMeal',cin='$Editcin',cout='$Editcout',noofdays = '$Editnoofday',roomtotal = '$editttot',bedtotal = '$editbtot',mealtotal = '$editmepr',finaltotal = '$editfintot' WHERE id = '$id'";

    $paymentresult = mysqli_query($conn,$psql);

    if ($paymentresult) {
            header("Location:roombook.php");
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./css/roombook.css">
    <style>
        #editpanel{
            position : fixed;
            z-index: 1000;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            /* align-items: center; */
            background-color: #00000079;
        }
        #editpanel .guestdetailpanelform{
            height: 620px;
            width: 1170px;
            background-color: #ccdff4;
            border-radius: 10px;  
            /* temp */
            position: relative;
            top: 20px;
            animation: guestinfoform .3s ease;
        }

    </style>
    <title>Document</title>
</head>
<body>
    <div id="editpanel">
    <form action="staffbackend.php" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>EDIT STAFF</h3>
                <a href="./staffs.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Personal information</h4>
                    <label for="name"> Full Name </label>
                    <input type="text" id="name" name="name" placeholder="Enter Full name" value="<?php echo $name ?>">
                    <span id="error_name" style="color: red;"></span>

                    <label for="phone"> Phone Number </label>
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone ?>">
                    <span id="error_phone" style="color: red;"></span>

                    <label for="gender"> Select Gender </label>
                    <select name="gender" class="selectinput">
						<option value="<?php echo $gender ?>"><?php echo $gender ?></option>
                        <option>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <label for="address"> Address </label>
                    <input type="text" name="address" placeholder="Enter Address" value="<?php echo $address ?>">
                    <label for="date_employed"> Date Employed </label>
                    <input type="date" name="date_employed" placeholder="Enter Date Employed" value="<?php echo $date_employed ?>">
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Log in information</h4>
                    <label for="email"> Email </label>
                    <input type="email" name="email" placeholder="Enter Email Address" value="<?php echo $email ?>">

                    <label for="role"> Select Role </label>
                    <select name="role" class="selectinput">
                    <option value="<?php echo $role ?>"><?php echo $role ?></option>
						<option>Select Role</option>
                        <option value="Manager">Manager</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Cleaner">Cleaner</option>
                        <option value="Store Keeper">Store Keeper</option>
                    </select>
                    <!-- <input type="text" name="address" placeholder="Enter Address"> -->
                    <label for="password"> Password </label>
                    <input type="text" id="password" name="password" placeholder="Enter Password" value="<?php echo $password ?>">
                    <span id="error_password" style="color: red;"></span>


                    <span id="error_conpassword" style="color: red;"></span>
<br>
                    <div class="footer">
                <button type="submit" name="register_btn" class="btn btn-success" onclick="return validate()">Submit</button>
            </div>
                </div>
            </div>
            
        </form>
    </div>
</body>
</html>