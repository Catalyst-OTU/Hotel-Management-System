<?php

include '../config.php';

// fetch room data
$id = $_GET['id'];

// Corrected SQL query
$sql = "SELECT * FROM room WHERE id = '$id'";
$re = mysqli_query($conn, $sql);

// Check if the query was successful
if ($re) {
    while ($row = mysqli_fetch_array($re)) {
        $type = $row['type'];
        $bedding = $row['bedding'];
        $price = $row['price'];
        $NoofRoom = $row['NoofRoom'];
    }
} else {
    // Handle the error if the query failed
    echo "Error: " . mysqli_error($conn);
}

if (isset($_POST['roomedit'])) {
    //$id = $_POST['id']; // Assuming you are getting the id of the room being edited
    $Edittype = $_POST['type'];
    $Editbedding = $_POST['bedding'];
    $Editprice = $_POST['price'];
    $EditNoofRoom = $_POST['NoofRoom'];

    // Retrieve the current NoofRoom value from the room table
    $sql = "SELECT NoofRoom FROM room WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $currentNoofRoom = $row['NoofRoom'];

        // Update the room table
        $sql = "UPDATE room SET type = '$Edittype', bedding = '$Editbedding', price='$Editprice', NoofRoom='$EditNoofRoom' WHERE id = '$id'";
        $updateResult = mysqli_query($conn, $sql);

        if ($updateResult) {
            if ($currentNoofRoom != $EditNoofRoom) {
                // Retrieve the current totalRooms from the settings table
                $sql = "SELECT totalRooms FROM settings WHERE id = 1";
                $Settingsresult = mysqli_query($conn, $sql);

                if ($Settingsresult && $row = mysqli_fetch_assoc($Settingsresult)) {
                    $currentTotalRooms = $row['totalRooms'];

                    // Calculate the new totalRooms value
                    $newTotalRooms = $currentTotalRooms + ($EditNoofRoom - $currentNoofRoom);

                    // Update the settings table with the new totalRooms value
                    $sql = "UPDATE settings SET totalRooms = '$newTotalRooms' WHERE id = 1";
                    $UpdateSettingsresult = mysqli_query($conn, $sql);

                    if (!$UpdateSettingsresult) {
                        echo "<script>swal({
                            title: 'Failed to update total rooms',
                            icon: 'error',
                        });
                        </script>";
                    }
                } else {
                    echo "<script>swal({
                        title: 'Failed to retrieve current total rooms',
                        icon: 'error',
                    });
                    </script>";
                }
            }

            header("Location: rooms.php");
            exit(); // Make sure to exit after redirection
        } else {
            // Handle the error if the update failed
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Room not found.";
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
        <form method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>EDIT ROOM</h3>
                <a href="./rooms.php"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <input type="text" id="type" name="type" placeholder="Enter Type of Room" value="<?php echo $type ?>">
                    <span id="error_name" style="color: red;"></span>

                    <input type="text" id="bedding" name="bedding" placeholder="Enter Type of Bed required" value="<?php echo $bedding ?>">
                    <span id="error_name" style="color: red;"></span>


                    <input type="text" id="price" name="price" placeholder="Enter Price" value="<?php echo $price ?>">
                    <span id="error_name" style="color: red;"></span>


                    <input type="number" id="price" name="NoofRoom" placeholder="Enter Price" value="<?php echo $NoofRoom ?>">
                    <span id="error_name" style="color: red;"></span>
                


                    <br>
                    <div class="footer">
                        <button type="submit" name="roomedit" class="btn btn-success" onclick="return validate()">Submit</button>
                    </div>

                    </div>
            </div>
        </form>
    </div>
</body>
</html>