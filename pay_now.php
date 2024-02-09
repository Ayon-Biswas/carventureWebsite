<?php
require ('admin/inc/db_config.php');
require ('admin/inc/essentials.php');
date_default_timezone_set("Asia/Dhaka");

session_start();
$_SESSION['car'];

if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
}

if(isset($_POST['pay_now'])){
    // Insert payment data into db
    $frm_data = filteration($_POST);

    $query = "INSERT INTO `booking_details`( `user_name`, `phonenum`, `address`, `pickup`, `dropoff`) 
        VALUES (?,?,?,?,?)";

    $result = insert($query, [
        $frm_data['name'],
        $frm_data['phonenum'],
        $frm_data['address'],
        $frm_data['pickup'],
        $frm_data['dropoff']
    ], 'sssss');

    if ($result) {
        echo '<script>alert("Car booked");</script>';
        redirect('cars.php');
    } else {
        echo '<script>alert("Booking failed");</script>';
    }
}




?>