<?php
    session_start();
    include '../config.php';

    // roombook
    $roombooksql ="SELECT SUM(NoofRoom) AS totalRoomBook FROM roombook";
    $roombookrow = mysqli_query($conn, $roombooksql);

       // Check if the query was successful
       if ($roombookrow) {
        // Fetch the result as an associative array
        $totalroomrow = mysqli_fetch_assoc($roombookrow);
    
        // Access the summed value using the key 'totalRooms'
        $totalRoomBook = $totalroomrow['totalRoomBook'];
    } else {
        // Handle the error if the query fails
        $totalRoomBook = 'Error in query';
    }


    $roombookguestsql ="Select * from roombook";
    $roombookguestre = mysqli_query($conn, $roombookguestsql);
    $roombookguestrow = mysqli_num_rows($roombookguestre);


    // staff
    $staffsql ="Select * from staff";
    $staffre = mysqli_query($conn, $staffsql);
    $staffrow = mysqli_num_rows($staffre);

    // room
    $roomsql = "SELECT SUM(totalRooms) AS totalRooms FROM settings";
    $roomre = mysqli_query($conn, $roomsql);

    // Check if the query was successful
    if ($roomre) {
        // Fetch the result as an associative array
        $roomrow = mysqli_fetch_assoc($roomre);
    
        // Access the summed value using the key 'totalRooms'
        $totalRooms = $roomrow['totalRooms'];
    } else {
        // Handle the error if the query fails
        $totalRooms = 'Error in query';
    }

    //roombook roomtype
    $chartroom1 = "SELECT * FROM roombook WHERE RoomType='Superior Room'";
    $chartroom1re = mysqli_query($conn, $chartroom1);
    $chartroom1row = mysqli_num_rows($chartroom1re);

    $chartroom2 = "SELECT * FROM roombook WHERE RoomType='Deluxe Room'";
    $chartroom2re = mysqli_query($conn, $chartroom2);
    $chartroom2row = mysqli_num_rows($chartroom2re);

    $chartroom3 = "SELECT * FROM roombook WHERE RoomType='Guest House'";
    $chartroom3re = mysqli_query($conn, $chartroom3);
    $chartroom3row = mysqli_num_rows($chartroom3re);

    $chartroom4 = "SELECT * FROM roombook WHERE RoomType='Single Room'";
    $chartroom4re = mysqli_query($conn, $chartroom4);
    $chartroom4row = mysqli_num_rows($chartroom4re);
?>
<!-- moriss profit -->
<?php 	
					$query = "SELECT * FROM payment";
					$result = mysqli_query($conn, $query);
					$chart_data = '';
					$tot = 0;
					while($row = mysqli_fetch_array($result))
					{
              // $chart_data .= "{ date:'".$row["cout"]."', profit:".$row["finaltotal"]*10/100 ."}, ";
              $chart_data .= "{ date:'".$row["cout"]."', profit:".$row["finaltotal"] ."}, ";
              // $tot = $tot + $row["finaltotal"]*10/100;
              $tot =  $row["finaltotal"];
					}

					$chart_data = substr($chart_data, 0, -2);
				
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- morish bar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <title>BlueBird Hotel- Admin </title>
</head>
<body>
   <div class="databox">
        <div class="box roombookbox">
          <h2>Total Booked Room</h1>  
          <h1><?php echo $totalRoomBook ?> / <?php echo $totalRooms ?></h1>
        </div>
        <div class="box guestbox">
        <h2>Total Staff</h1>  
          <h1><?php echo $staffrow ?></h1>
        </div>
        <div class="box roombookbox">
          <h2>Total Guests</h1>  
          <h1><?php echo $roombookguestrow ?></h1>
        </div>
        <div class="box profitbox">
        <h2>Revenue</h1>  
          <h1><span>₵</span><?php echo $tot?></h1>
        </div>
    </div>
    <div class="chartbox">
        <div class="bookroomchart">
            <canvas id="bookroomchart"></canvas>
            <h3 style="text-align: center;margin:10px 0;">Booked Room</h3>
        </div>
        <div class="profitchart" >
            <div id="profitchart"></div>
            <h3 style="text-align: center;margin:10px 0;">Revenue Chart</h3>
        </div>
    </div>
</body>



<?php
// Assume you have already established a database connection in $conn

// Query to fetch room types
$roomsql = "SELECT RoomType, Bed, NoofRoom FROM roombook";
$roomre = mysqli_query($conn, $roomsql);

// Initialize arrays to hold room labels and number of rooms
$room_labels = [];
$NoofRoom = [];

// Fetch room types and add them to the arrays
while ($row = mysqli_fetch_assoc($roomre)) {
    $room_labels[] = $row['RoomType'] . ': ' . $row['Bed']; // Combine RoomType and Bed
    $NoofRoom[] = $row['NoofRoom'];
}

// Encode the arrays as JSON
$room_labels_json = json_encode($room_labels);
$NoofRoom_json = json_encode($NoofRoom);
?>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Get the room labels and number of rooms from PHP and parse them into JavaScript arrays
  const labels = <?php echo $room_labels_json; ?>;
  const dataValues = <?php echo $NoofRoom_json; ?>;

  // Define an array of colors, making sure it matches the number of segments
  const colors = [
    'rgba(255, 99, 132, 0.6)',  // Light pink
    'rgba(255, 159, 64, 0.6)',  // Light orange
    'rgba(54, 162, 235, 0.6)',  // Light blue
    'rgba(153, 102, 255, 0.6)',  // Light purple
    'rgba(75, 192, 192, 0.6)',  // Light teal
    'rgba(255, 205, 86, 0.6)'   // Light yellow
    // Add more colors if you have more segments
  ];

  // Ensure the colors array is at least as long as the number of data segments
  const datasetColors = colors.slice(0, dataValues.length);

  const data = {
    labels: labels,
    datasets: [{
      label: 'Number of Rooms',
      backgroundColor: datasetColors,
      borderColor: 'black',
      data: dataValues,
    }]
  };

  const doughnutchart = {
    type: 'doughnut',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              let label = context.label || '';
              if (context.parsed) {
                label += ': ' + context.parsed + ' rooms';
              }
              return label;
            }
          }
        }
      }
    }
  };

  const myChart = new Chart(
    document.getElementById('bookroomchart'),
    doughnutchart
  );
</script>





<script>
Morris.Bar({
 element : 'profitchart',
 data:[<?php echo $chart_data;?>],
 xkey:'date',
 ykeys:['profit'],
 labels:['Sales'],
 hideHover:'auto',
 stacked:true,
 barColors:[
  'rgba(153, 102, 255, 1)',
 ]
});
</script>

</html>