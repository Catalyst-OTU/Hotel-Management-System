<?php
session_start();
include '../config.php';

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
    <title>BlueBird Hotel- Admin</title>
</head>

<body>
    <!-- guestdetailpanel -->

    <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>ADD NEW ROOM</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adduserclose()"></i>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <input type="text" id="type" name="type" placeholder="Enter Type of Room" required>
                    <span id="error_name" style="color: red;"></span>

                    <input type="text" id="bedding" name="bedding" placeholder="Enter Type of Bed required" required>
                    <span id="error_name" style="color: red;"></span>


                    <input type="text" id="price" name="price" placeholder="Enter Price" required>
                    <span id="error_name" style="color: red;"></span>


                    <input type="number" id="price" name="NoofRoom" placeholder="Enter Available Rooms" required>
                    <span id="error_name" style="color: red;"></span>
            

                    <br>
                    <div class="footer">
                        <button type="submit" name="createroom" class="btn btn-success" onclick="return validate()">Submit</button>
                    </div>

                    </div>
            </div>
            
        </form>
        
       
        <!-- ==== room book php ====-->
        <?php
if (isset($_POST['createroom'])) {
    $type = $_POST['type'];
    $bedding = $_POST['bedding'];
    $price = $_POST['price'];
    $NoofRoom = $_POST['NoofRoom'];

    if($type == "" || $bedding == "" || $price == "" || $NoofRoom == ""){
        echo "<script>swal({
            title: 'Fill the proper details',
            icon: 'error',
        });
        </script>";
    } else {
        // Insert new room into the room table
        $sql = "INSERT INTO room (type, bedding, price, NoofRoom) VALUES ('$type', '$bedding', '$price', '$NoofRoom')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Retrieve the current totalRooms from the settings table
            $sql = "SELECT totalRooms FROM settings WHERE id = 1";
            $result = mysqli_query($conn, $sql);
            
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $currentTotalRooms = $row['totalRooms'];

                // Calculate the new totalRooms value
                $newTotalRooms = $currentTotalRooms + $NoofRoom;

                // Update the settings table with the new totalRooms value
                $sql = "UPDATE settings SET totalRooms = '$newTotalRooms' WHERE id = 1";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<script>swal({
                        title: 'Room created successfully',
                        icon: 'success',
                    });
                    </script>";
                } else {
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
        } else {
            echo "<script>swal({
                title: 'Something went wrong',
                icon: 'error',
            });
            </script>";
        }
    }
}
?>

    </div>

    
    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button class="adduser" id="adduser" onclick="adduseropen()"><i class="fa-solid fa-bookmark"></i> Add</button>

    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $roomsqltable = "SELECT * FROM room";
            $roomType  = mysqli_query($conn, $roomsqltable);
            $nums = mysqli_num_rows($roomType );
        ?>
       <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Type of Room</th>
                    <th scope="col">Type of Bed</th>
                    <th scope="col">Price</th>
                    <th scope="col">Available Rooms</th>
                    <th scope="col">IsBooked</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
    
                </tr>
            </thead>

            <tbody>
            <?php
            while ($res = mysqli_fetch_array($roomType)) {
            ?>
                <tr>
                    <td><?php echo $res['type'] ?></td>
                    <td><?php echo $res['bedding'] ?></td>
                    <td><?php echo $res['price'] ?></td>
                    <td><?php echo $res['NoofRoom'] ?></td>
                    <td><?php echo $res['roomBooked'] ?></td>
                    <td><?php echo $res['created_at'] ?></td>
                    <td><?php echo $res['updated_at'] ?></td>

                    <td class="action">
                    <a href="editroom.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                    <a href="deleteroom.php?id=<?php echo $res['id'] ?>" onclick="if (!confirm('Are you sure you want to delete <?php echo $res['type'] ?>')) return false"><button class='btn btn-danger'>Delete</button></a>

                    </td>
                </tr>
            <?php

            }
            ?>
            </tbody>
        </table>
    </div>
</body>
<script src="./javascript/roombook.js"></script>
<script src="./javascript/validation.js"></script>






</html>
