<?php

include '../config.php';

$sqlq = "SELECT * FROM roombook";
$result = mysqli_query($conn,$sqlq);
$roombook_record = array();

while( $rows = mysqli_fetch_assoc($result)){
    $roombook_record[] = $rows;
}

if(isset($_POST["exportexcel"]))
{
    $filename = "bluebird_roombook_data_".date('Ymd') .".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $show_coloumn = false;
    if(!empty($roombook_record)){
        foreach($roombook_record as $record){
            if(!$show_coloumn){
                echo implode("\t",array_keys($record)) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}







$sqlq = "SELECT * FROM staff";
$result = mysqli_query($conn,$sqlq);
$staff_record = array();

while( $rows = mysqli_fetch_assoc($result)){
    $staff_record[] = $rows;
}

if(isset($_POST["exportstaffexcel"]))
{
    $filename = "bluebird_staff_data_".date('Ymd') .".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $show_coloumn = false;
    if(!empty($staff_record)){
        foreach($staff_record as $record){
            if(!$show_coloumn){
                echo implode("\t",array_keys($record)) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}













// Capture filter parameters
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';



$sqlq = "SELECT * FROM roombook";

if ($startDate && $endDate) {
    $sqlq .= " WHERE cin >= '$startDate' AND cout <= '$endDate'";
}

$result = mysqli_query($conn,$sqlq);
$staff_record = array();

while( $rows = mysqli_fetch_assoc($result)){
    $staff_record[] = $rows;
}

if(isset($_POST["exportguestexcel"]))
{
    $filename = "bluebird_guest_data_".date('Ymd') .".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $show_coloumn = false;
    if(!empty($staff_record)){
        foreach($staff_record as $record){
            if(!$show_coloumn){
                echo implode("\t",array_keys($record)) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}

?>