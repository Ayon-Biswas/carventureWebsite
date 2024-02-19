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
    session_start();

    $query = "INSERT INTO `booking_details`(`car_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`, `pickup`, `dropoff`) 
        VALUES (?,?,?,?,?,?,?,?)";

    $result = insert($query, [
        $_SESSION['car']['name'],
        $_SESSION['car']['price'],
        $_SESSION['car']['payment'],
        $frm_data['name'],
        $frm_data['phonenum'],
        $frm_data['address'],
        $frm_data['pickup'],
        $frm_data['dropoff']
    ], 'ssssssss');

    if ($result) {
        echo '<script>alert("success","Car booked");</script>';
        redirect('cars.php');
    } else {
        echo '<script>alert("error","Booking failed");</script>';
    }
}




?>