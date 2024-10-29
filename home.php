<?php

include 'config.php';
session_start();

// page redirect
$useremail="";
$useremail=$_SESSION['usermail'];
$username="";
$username=$_SESSION['username'];
if($useremail == true){

}else{
  header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Blue Bird Hotel</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <link rel="stylesheet" href="styles.css">
    <style>
      #guestdetailpanel{
        display: none;
      }
      #guestdetailpanel .middle{
        height: 450px;
      }

    </style>
</head>

<body onload="openbookbox()">

<button class="openbtn" onclick="openNav()">&#9776; <!-- Hamburger icon --></button>


<div id="mySidebar" class="sidebar">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="#firstsection">Home</a>
    <a href="#secondsection">Rooms</a>
    <a href="#thirdsection">Facilites</a>
    <a href="#lastFooter">contact us</a>
    <a href="auth.php">Sign In</a>
</div>



  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
      <p>BLUEBIRD HOTEL</p>
    </div>
    <ul>
      <li><a href="#firstsection">Home</a></li>
      <li><a href="#secondsection">Rooms</a></li>
      <li><a href="#thirdsection">Facilites</a></li>
      <li><a href="#contactus">contact us</a></li>
      <a href="./logout.php" onclick="if (!confirm('Are you sure you want to logout')) return false"><button class="btn btn-danger">Logout</button></a>
    </ul>
  </nav>

  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="carousel-image" src="./image/hotel1.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel2.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel3.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/hotel4.jpg">
        </div>

        <div class="welcomeline">
          <h1 class="welcometag">Welcome to heaven on earth</h1>
        </div>

      <!-- bookbox -->
      <div id="guestdetailpanel">
      <form action="" method="POST" class="guestdetailpanelform">
            <div class="head">
                <h3>RESERVATION</h3>
                <i class="fa-solid fa-circle-xmark" onclick="adduserclose()"></i>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Guest information</h4>
                    <input type="text" name="Name" placeholder="Enter Full name" value="<?php echo $username ?>" required>
                    <input type="email" name="Email" placeholder="Enter Email" value="<?php echo $useremail ?>" required>

                    <?php
                    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                    ?>

                    <select name="Country" class="selectinput" required>
						<option value selected >Select your country</option>
                        <?php
							foreach($countries as $key => $value):
							echo '<option value="'.$value.'">'.$value.'</option>';
                            //close your tags!!
							endforeach;
						?>
                    </select>
                    <input type="text" name="Phone" placeholder="Enter Phoneno" required>

                    <div class="datesection">
                        <span>
                            <label for="cin"> Check-In</label>
                            <input name="cin" type ="date" required>
                        </span>
                        <span>
                            <label for="cin"> Check-Out</label>
                            <input name="cout" type ="date" required>
                        </span>
                    </div>


                </div>

                <div class="line"></div>

                <div class="reservationinfo">
                    <h4>Reservation information</h4>

                    <?php
// Fetch all relevant data in a single query
$sql = "SELECT type, bedding, price, NoofRoom FROM room WHERE NoofRoom >= 1";
$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

$roomOptions = [];
$roomData = [];

// Organize data by room type and bedding
while ($row = mysqli_fetch_assoc($query)) {
    $roomType = htmlspecialchars($row['type']);
    $beddingType = htmlspecialchars($row['bedding']);
    $price = htmlspecialchars($row['price']);
    $NoofRoom = htmlspecialchars($row['NoofRoom']);
    
    // Initialize room type if not set
    if (!isset($roomData[$roomType])) {
        $roomData[$roomType] = [];
    }
    
    // Store bedding, price, and NoofRoom in the array
    $roomData[$roomType][$beddingType] = [
        'price' => $price,
        'NoofRoom' => $NoofRoom
    ];
}

mysqli_free_result($query);

// Encode data to JSON format for use in JavaScript
$roomDataJson = json_encode($roomData);
?>


<!-- Output room type dropdown -->
<select name="RoomType" id="RoomType" class="selectinput" required>
    <option value="" selected>Select Room</option>
    <?php
    foreach (array_keys($roomData) as $roomType) {
        echo "<option value=\"$roomType\">$roomType</option>";
    }
    ?>
</select>

<!-- Output bed type dropdown -->
<select name="Bed" id="Bed" class="selectinput" required>
    <option value="" selected>Select Bedding Type</option>
</select>

<!-- Display price -->
<input type="text" name="price" id="price" class="selectinput" placeholder="Price Per Room will appear here" value="" readonly>

<!-- Display number of rooms -->
<select name="NoofRoom" id="NoofRoom" class="selectinput" required>
    <option value="" selected>Select No of Room</option>
</select>


                    <!-- <select name="NoofRoom" class="selectinput">
						<option value selected >No of Room</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select> -->



                    <select name="Meal" class="selectinput" required>
						<option>Select Meal</option>
                        <option value="Room only">Room only</option>
                        <option value="Breakfast">Breakfast</option>
						<option value="Half Board">Half Board</option>
						<option value="Full Board">Full Board</option>
					</select>
    
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-success" name="guestdetailsubmit">Submit</button>
            </div>
        </form>
        <!-- ==== room book php ====-->

        <!-- ==== room book php ====-->
        <?php       
            if (isset($_POST['guestdetailsubmit'])) {
                $Name = $_POST['Name'];
                $Email = $_POST['Email'];
                $Country = $_POST['Country'];
                $Phone = $_POST['Phone'];
                $RoomType = $_POST['RoomType'];
                $Bed = $_POST['Bed'];
                $price = $_POST['price'];
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
                    $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,price,NoofRoom,Meal,cin,cout,stat,nodays) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$price','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
                    $result = mysqli_query($conn, $sql);
                  
                        if ($result) {

                            // Get the POST data
$roomType = isset($_POST['RoomType']) ? $_POST['RoomType'] : '';
$bedType = isset($_POST['Bed']) ? $_POST['Bed'] : '';
$noOfRoomsToBook = isset($_POST['NoofRoom']) ? (int)$_POST['NoofRoom'] : 0;

if ($roomType && $bedType && $noOfRoomsToBook > 0) {
    // Check if there are enough rooms available
    $checkAvailabilitySql = "SELECT NoofRoom FROM room WHERE type = ? AND bedding = ?";
    $stmt = mysqli_prepare($conn, $checkAvailabilitySql);
    mysqli_stmt_bind_param($stmt, 'ss', $roomType, $bedType);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $availableRooms);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($availableRooms >= $noOfRoomsToBook) {
        // Update the number of rooms and roomBooked status
        $updateRoomBookSql = "UPDATE room SET NoofRoom = NoofRoom - ?, roomBooked = 'Yes' WHERE type = ? AND bedding = ? AND NoofRoom >= ?";
        $stmt = mysqli_prepare($conn, $updateRoomBookSql);
        mysqli_stmt_bind_param($stmt, 'isis', $noOfRoomsToBook, $roomType, $bedType, $noOfRoomsToBook);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>swal({
                title: 'Room booked successfully.',
                icon: 'success',
            });
        </script>";
        } else {
            echo "<script>swal({
                title: 'Failed to update room count.',
                icon: 'error',
            });
        </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>swal({
            title: 'Not enough rooms available.',
            icon: 'error',
        });
    </script>";
    }
} else {
    echo "<script>swal({
        title: 'Invalid input.',
        icon: 'success',
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
                    // }
                }
            }
        ?>
          </div>

    </div>
  </section>
    
  <section id="secondsection"> 
    <img src="./image/homeanimatebg.svg">
    <div class="ourroom">
      <h1 class="head">≼ Our room ≽</h1>
      <div class="roomselect">
        <div class="roombox">
          <div class="hotelphoto h1"></div>
          <div class="roomdata">
            <h2>Superior Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
              <i class="fa-solid fa-person-swimming"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h2"></div>
          <div class="roomdata">
            <h2>Delux Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h3"></div>
          <div class="roomdata">
            <h2>Guest Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h4"></div>
          <div class="roomdata">
            <h2>Single Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
      </div>
    </div>
  </section>



  
  <br><br><br><br>
  <br><br><br><br>
  <br><br><br><br>
  <br><br><br><br>
  <br><br><br><br>
  <br><br><br><br>
  <br><br>

  <marquee behavior="" direction="">Welcome to <i style="color: blue; font-size: 30px">BLUEBIRD</i> <i> HOTEL</i> </marquee>



  
  <section id="thirdsection">
    <h1 class="head">≼ Facilities ≽</h1>
    <div class="facility">
      <div class="box">
        <h2>Swiming pool</h2>
      </div>
      <div class="box">
        <h2>Spa</h2>
      </div>
      <div class="box">
        <h2>24*7 Restaurants</h2>
      </div>
      <div class="box">
        <h2>24*7 Gym</h2>
      </div>
      <div class="box">
        <h2>Heli service</h2>
      </div>
    </div>
  </section>


  <style>
  .League{
    color: white;
    text-align: center;
}
.social-coins{
    /* margin-right: 50px; */
    text-align: center;
}
.social-coins img{
width: 30px;
margin: 0 6px;
box-shadow: 0 0 20px 0 #7f7f7f3d;
cursor: pointer;
border-radius: 50%;
}
.footer a{
  color: white;
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

.narBarItems li a{
  color: white;
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

.scroll-top {
    position: fixed;
        width: 30px;
        height: 30px;
        bottom: 10px;
        left:  5px;
}
</style>

<br><br><br><br>

  <div style="background-color: black;" id="lastFooter">
                <footer class="" align="center">
                    <div class="logo">
                        <img src="./image/bluebirdlogo.png" alt="logo" width=70 height=70>
                        <p style="color: white;">BLUEBIRD HOTEL</p>
                    </div>
                    <br><br>

                    <div class="social-coins">
                        <div  class="League">Follow Us On</div>
                         <br>
                        <a href="#"><img src="image/fb1.png"></a>
                        <a href="#"><img src="image/youtube icon.png"></a>
                        <img src="image/twitter.jpg">
                        
                    </div>
                    <br><br>


                    <ul class="nav nav-tab nav-justified narBarItems">
                        <li class="nav-item"><a class="nav-link nav1" href="#firstsection">Home</a></li>
                        <li class="nav-item"><a class="nav-link nav1" href="#secondsection">Rooms</a></li>
                        <li class="nav-item"><a class="nav-link nav1" href="#thirdsection">Facilites</a></li>
                        <li class="nav-item"><a class="nav-link nav1" href="auth.php">Sign In</a></li>
                    </ul>
                </footer>

                <ul class="footer" style="list-style: disc;" align="center">
                    <a href="#">Terms & Conditions</a>|<a href="#">Privacy Policy</a>|<a href="#">Sitemap</a>|&copy;<a href="#">CopyRight 2024</a>|<a href="#">All Right Reserved</a>
                </ul>
               

            </div>

            <a class="scroll-top" href="#"><img src="image/arrow1.png" width="30px" height="30px"></a>



  <!-- <section id="contactus">
    <div class="social">
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-solid fa-envelope"></i>
    </div>

    <div class="copyRight">
      <h5 style="color: white">Copyright &copy; 2024 All Rights Reserved</h5>
    </div>

    <div class="createdby">
      <h5>Created by Nana Kwesi</h5>
    </div>
    

  </section> -->

  <script src="script.js"></script>
</body>




<script>
    // Convert PHP JSON data to JavaScript object
    var roomData = <?php echo $roomDataJson; ?>;

    var roomTypeSelect = document.getElementById('RoomType');
    var bedTypeSelect = document.getElementById('Bed');
    var priceInput = document.getElementById('price');
    var noofRoomSelect = document.getElementById('NoofRoom');

    // Update bedType options based on selected roomType
    roomTypeSelect.addEventListener('change', function() {
        var selectedRoomType = this.value;

        // Clear previous bedType options and noofRoom options
        bedTypeSelect.innerHTML = '<option value="" selected>Select Bedding Type</option>';
        noofRoomSelect.innerHTML = '<option value="" selected>Select No of Room</option>';

        // Update bedType options based on selected roomType
        if (selectedRoomType in roomData) {
            for (var bedding in roomData[selectedRoomType]) {
                var option = document.createElement('option');
                option.value = bedding;
                option.textContent = bedding;
                bedTypeSelect.appendChild(option);
            }
        }
    });

    // Update price and noofRoom based on selected bedType
    bedTypeSelect.addEventListener('change', function() {
        var selectedRoomType = roomTypeSelect.value;
        var selectedBedType = this.value;

        // Clear previous noofRoom options
        noofRoomSelect.innerHTML = '<option value="" selected>Select No of Room</option>';

        if (selectedRoomType in roomData && selectedBedType in roomData[selectedRoomType]) {
            var roomInfo = roomData[selectedRoomType][selectedBedType];
            priceInput.value = roomInfo.price;

            // Add NoofRoom options if available
            var numberOfRooms = roomInfo.NoofRoom;
            if (numberOfRooms > 0) {
                for (var i = 1; i <= numberOfRooms; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    noofRoomSelect.appendChild(option);
                }
            } else {
                // Show "No Room Available" message
                var option = document.createElement('option');
                option.value = '';
                option.textContent = 'No Room Available';
                noofRoomSelect.appendChild(option);
            }
        } else {
            priceInput.value = '';
            noofRoomSelect.innerHTML = '<option value="" selected>Select No of Room</option>';
        }
    });

    // Handle noofRoom selection and send AJAX request
    noofRoomSelect.addEventListener('change', function() {
        var selectedRoomType = roomTypeSelect.value;
        var selectedBedType = bedTypeSelect.value;
        var selectedNoOfRooms = this.value;

        if (selectedNoOfRooms) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'roombook.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
            };
            xhr.send('RoomType=' + encodeURIComponent(selectedRoomType) +
                     '&Bed=' + encodeURIComponent(selectedBedType) +
                     '&NoofRoom=' + encodeURIComponent(selectedNoOfRooms));
        }
    });
</script>








<script>

function adduserclose() {
    document.getElementById("guestdetailpanel").style.display = "none";
  }

    var bookbox = document.getElementById("guestdetailpanel");

    openbookbox = () =>{
      bookbox.style.display = "flex";
    }
    closebox = () =>{
      bookbox.style.display = "none";
    }
</script>
</html>