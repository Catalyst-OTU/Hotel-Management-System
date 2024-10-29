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
        <form action="staffbackend.php" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>ADD NEW STAFF</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adduserclose()"></i>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Personal information</h4>
                    <input type="text" id="name" name="name" placeholder="Enter Full name" required>
                    <span id="error_name" style="color: red;"></span>

                    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    <span id="error_phone" style="color: red;"></span>

                    <select name="gender" class="selectinput">
						<option>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <input type="text" name="address" placeholder="Enter Address" required>
                    <label for="date_employed"> Date Employed </label>
                    <input type="date" name="date_employed" placeholder="Enter Date Employed" required>
                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Log in information</h4>
                    <input type="email" name="email" placeholder="Enter Email Address" required>
                    <select name="role" class="selectinput">
						<option>Select Role</option>
                        <option value="Manager">Manager</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Cleaner">Cleaner</option>
                        <option value="Store Keeper">Store Keeper</option>
                    </select>
                    <!-- <input type="text" name="address" placeholder="Enter Address" required> -->
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <span id="error_password" style="color: red;"></span>


                    <input type="password" id="conpassword" name="conpassword" placeholder="Confirm Paasword" required> 
                    <span id="error_conpassword" style="color: red;"></span>
<br>
                    <div class="footer">
                <button type="submit" name="register_btn" class="btn btn-success" onclick="return validate()">Submit</button>
            </div>
                </div>
            </div>
            
        </form>
        
       
        <!-- ==== room book php ====-->
        <?php       
            if (isset($_POST['guestdetailsubmit'])) {
                $Name = $_POST['Name'];
                $Email = $_POST['Email'];
                $Country = $_POST['Country'];
                $Phone = $_POST['Phone'];
                $RoomType = $_POST['RoomType'];
                $Bed = $_POST['Bed'];
                $NoofRoom = $_POST['NoofRoom'];
                $Meal = $_POST['Meal'];
                $cin = $_POST['cin'];
                $cout = $_POST['cout'];

                if($Name == "" || $Email == "" || $Country == ""){
                    echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
                }
                else{
                    $sta = "NotConfirm";
                    $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
                    $result = mysqli_query($conn, $sql);

                    // if($f1=="NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Superior Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f2=="NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Guest House is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f3 == "NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Si Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($f4 == "NO")
                    // {
                    //     echo "<script>swal({
                    //         title: 'Deluxe Room is not available',
                    //         icon: 'error',
                    //     });
                    //     </script>";
                    // }
                    // else if($result = mysqli_query($conn, $sql))
                    // {
                        if ($result) {
                            echo "<script>swal({
                                title: 'Reservation successful',
                                icon: 'success',
                            });
                        </script>";
                        } else {
                            echo "<script>swal({
                                    title: 'Something went wrong',
                                    icon: 'error',
                                });
                        </script>";
                        }
                    // }
                }
            }
        ?>
    </div>

    
    <!-- ================================================= -->
    <div class="searchsection">
        <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()">
        <button class="adduser" id="adduser" onclick="adduseropen()"><i class="fa-solid fa-bookmark"></i> Add</button>
        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>

    <div class="roombooktable" class="table-responsive-xl">
        <?php
            $staffsql = "SELECT * FROM staff";
            $stattsqlresults = mysqli_query($conn, $staffsql);
            $nums = mysqli_num_rows($stattsqlresults);
        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Date Employed</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <!-- <th scope="col">Check-In</th>
                    <th scope="col">Check-Out</th>
                    <th scope="col">No of Day</th>
                    <th scope="col">Status</th> -->
                    <th scope="col" class="action">Action</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>

            <tbody>
            <?php
            while ($res = mysqli_fetch_array($stattsqlresults)) {
            ?>
                <tr>
                    <td><?php echo $res['name'] ?></td>
                    <td><?php echo $res['role'] ?></td>
                    <td><?php echo $res['date_employed'] ?></td>
                    <td><?php echo $res['phone'] ?></td>
                    <td><?php echo $res['email'] ?></td>
                    <td><?php echo $res['gender'] ?></td>
                    <td><?php echo $res['address'] ?></td>
                    <td><?php echo $res['created_at'] ?></td>
                    <td><?php echo $res['updated_at'] ?></td>
                    <td class="action">
                        <a href="staffedit.php?id=<?php echo $res['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                        <a href="roombookdelete.php?id=<?php echo $res['id'] ?>" onclick="if (!confirm('Are you sure you want to delete <?php echo $res['name'] ?>')) return false"><button class='btn btn-danger'>Delete</button></a>
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
