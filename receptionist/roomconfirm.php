<?php

include '../config.php';

$id = $_GET['id'];

$sql ="Select * from roombook where id = '$id'";
$re = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($re))
{
	$Name = $row['Name'];
    $Email = $row['Email'];
    $Country = $row['Country'];
    $Phone = $row['Phone'];
    $RoomType = $row['RoomType'];
    $Bed = $row['Bed'];
    $RoomPrice = $row['price'];
    $NoofRoom = $row['NoofRoom'];
    $Meal = $row['Meal'];
    $cin = $row['cin'];
    $cout = $row['cout'];
    $noofday = $row['nodays'];
    $stat = $row['stat'];
    $PricePerRoomForRoomType = $row['price'];
    $PricePerRoomForBed = $row['price'];
    $PricePerRoom = $row['price'];
}


if($stat == "NotConfirm")
{
    $st = "Confirm";

    $sql = "UPDATE roombook SET stat = '$st' WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);

    if($result){

        //$type_of_room = 0;      
        if($RoomType=="Superior Room")
        {
            $RoomPrice = $PricePerRoomForRoomType;
        }
        else if($RoomType=="Deluxe Room")
        {
            $RoomPrice = $PricePerRoomForRoomType;
        }
        else if($RoomType=="Guest House")
        {
            $RoomPrice = $PricePerRoomForRoomType;
        }
        else if($RoomType=="Single Room")
        {
            $RoomPrice = $PricePerRoomForRoomType;
        }
        
        
        if($Bed=="Single")
        {
            $type_of_bed = $RoomPrice * 1/100;
        }
        else if($Bed=="Double")
        {
            $type_of_bed = $RoomPrice * 2/100;
        }
        else if($Bed=="Triple")
        {
            $type_of_bed = $RoomPrice * 3/100;
        }
        else if($Bed=="Quad")
        {
            $type_of_bed = $RoomPrice * 4/100;
        }
            else if($Bed=="None")
        {
            $type_of_bed = $RoomPrice * 0/100;
        }

        if($Meal=="Room only")
        {
            $type_of_meal=$type_of_bed * 0;
        }
        else if($Meal=="Breakfast")
        {
            $type_of_meal=$type_of_bed * 2;
        }
        else if($Meal=="Half Board")
        {
            $type_of_meal=$type_of_bed * 3;
        }
        else if($Meal=="Full Board")
        {
            $type_of_meal=$type_of_bed * 4;
        }
                                                            
        $ttot = $PricePerRoom *  $noofday * $NoofRoom;
        $mepr = $type_of_meal *  $noofday;
        //$btot = $type_of_bed * $noofday;

        $fintot = $ttot + $mepr;

        $psql = "INSERT INTO payment(id,Name,Email,RoomType,PricePerRoom,Bed,NoofRoom,cin,cout,noofdays,roomtotal,meal,mealtotal,finaltotal) VALUES ('$id', '$Name', '$Email', '$RoomType', '$PricePerRoom', '$Bed', '$NoofRoom', '$cin', '$cout', '$noofday', '$ttot',  '$Meal', '$mepr', '$fintot')";

        mysqli_query($conn,$psql);

        header("Location:roombook.php");
    }
}
// else
// {
//     echo "<script>alert('Guest Already Confirmed')</script>";
//     header("Location:roombook.php");
// }


?>