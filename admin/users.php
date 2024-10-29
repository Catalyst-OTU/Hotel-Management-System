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
    <title>BlueBird Hotel- Admin</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
	<!-- css for table and search bar -->
	<link rel="stylesheet" href="css/roombook.css">
    <style>
        .filter-form {
    display: flex;
    align-items: center;
    gap: 80px; /* Adjust spacing between elements */
}

.form-group {
    margin: 0; /* Remove margin for form groups */
}

.form-control {
    margin-right: 10px; /* Adjust spacing between input fields and the button */
}
label{
    color: white;
}

    </style>

</head>
<body>







	<div class="searchsection">
        <!-- <input type="text" name="search_bar" id="search_bar" placeholder="search..." onkeyup="searchFun()"> -->
        <form method="GET" action="" class="filter-form">
    <div class="form-group">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" class="form-control" value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" class="form-control" value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

        <form action="./exportdata.php" method="post">
            <button class="exportexcel" id="exportexcel" name="exportguestexcel" type="submit"><i class="fa-solid fa-file-arrow-down"></i></button>
        </form>
    </div>

    <br><br><br>



    <div class="roombooktable" class="table-responsive-xl">
        <?php

    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

    // Base SQL query
    $roomsqltable = "SELECT * FROM roombook";
    
    // Add date filter to SQL query if dates are provided
    if ($startDate && $endDate) {
        $roomsqltable .= " WHERE cin >= '$startDate' AND cout <= '$endDate'";
    }

    // Execute the query
    $roomType = mysqli_query($conn, $roomsqltable);

    // Get the number of results
    $nums = mysqli_num_rows($roomType);


        ?>
        <table class="table table-bordered" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Country</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Number of Days</th>

                </tr>
            </thead>

            <tbody>
            <?php
            while ($res = mysqli_fetch_assoc($roomType)) {

            ?>
            <tr>
                <td><?php echo htmlspecialchars($res['Name']); ?></td>
                <td><?php echo htmlspecialchars($res['Email']); ?></td>
                <td><?php echo htmlspecialchars($res['Country']); ?></td>
                <td><?php echo htmlspecialchars($res['Phone']); ?></td>
                <td><?php echo htmlspecialchars($res['cin']); ?></td>
                <td><?php echo htmlspecialchars($res['cout']); ?></td>
                <td><?php echo htmlspecialchars($res['nodays']); ?></td>
            </tr>
            <?php
            }

            ?>
            </tbody>
        </table>

    </div>
</body>

<script>
    //search bar logic using js
    const searchFun = () =>{
        let filter = document.getElementById('search_bar').value.toUpperCase();

        let myTable = document.getElementById("table-data");

        let tr = myTable.getElementsByTagName('tr');

        for(var i = 0; i< tr.length;i++){
            let td = tr[i].getElementsByTagName('td')[1];

            if(td){
                let textvalue = td.textContent || td.innerHTML;

                if(textvalue.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }
        }

    }

</script>

</html>