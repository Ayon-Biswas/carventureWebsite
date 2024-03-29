<?php 
require ('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require ('inc/links.php');?>
</head>

<body class="bg-light">
<?php 
require ('inc/header.php');

$is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

$unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(`sr_no`) AS `count` 
   FROM `user_queries` WHERE `seen`=0"));

$total_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(`sr_no`) AS `count` 
   FROM `user_queries` "));

$total_reg = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(`id`) AS `count` 
   FROM `user_cred` "));

$current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(id) AS `total`,
        COUNT( CASE WHEN `status`=1 THEN 1 END) AS `active`, 
        COUNT( CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
        COUNT( CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
        FROM `user_cred` "));

$current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(sr_no) AS `total_bookings`,
        SUM(total_pay) AS `total_amount`,

        COUNT( CASE WHEN `status`=1 THEN 1 END) AS `active_bookings`,
        SUM( CASE WHEN `status`=1 THEN `total_pay` END) AS `active_amount`,

        COUNT( CASE WHEN `status`=0 THEN 1 END) AS `canceled_bookings`,
        SUM( CASE WHEN `status`=0 THEN `total_pay` END) AS `canceled_amount`
        FROM `booking_details` "));
?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
               <!-- shutdown badge section -->
              <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>DASHBOARD</h3>
                <?php
                if($is_shutdown['shutdown']){
                  echo<<<data
                  <h6 class="badge bg-danger py-2 px-3 rounded">Shutdown Mode is Active!</h6>
                  data;
                }
                ?>
                
              </div>
               <!-- user queries info in card -->
              <div class="row mb-4">
                <div class="col-md-12 mb-4">
                  <a href="user_queries.php" class="text-decoration-none">
                    <div class="card text-center p-3 text-info">
                       <h6>User Queries</h6>
                       <h1 class="mt-2 mb-0"><?php echo $unread_queries['count']?></h1>
                    </div>
                  </a>
                </div>

              </div>
              <!-- booking analytics section -->
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Booking Analytics</h5>
              </div>

              <div class="row mb-3">
                 <div class="col-md-4 mb-4">
                    <div class="card text-center p-3 text-primary">
                       <h6>Total Bookings</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_bookings['total_bookings']?></h1>
                       <h1 class="mt-2 mb-0">৳ <?php echo $current_bookings['total_amount']?></h1>
                    </div>
                 </div>
                 <div class="col-md-4 mb-4">
                    <div class="card text-center p-3 text-success">
                       <h6>Active Bookings</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_bookings['active_bookings']?></h1>
                       <h1 class="mt-2 mb-0">৳ <?php echo $current_bookings['active_amount']?></h1>
                    </div>
                 </div>
                 <div class="col-md-4 mb-4">
                    <div class="card text-center p-3 text-danger">
                       <h6>Canceled Bookings</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_bookings['canceled_bookings']?></h1>
                       <h1 class="mt-2 mb-0">৳ <?php echo $current_bookings['canceled_amount']?></h1>
                    </div>
                 </div>
              </div>

              <!-- user,queries analytics section -->
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Users & Queries Analytics</h5>
              </div>

              <div class="row mb-3">
                 <div class="col-md-6 mb-4">
                    <div class="card text-center p-3 text-success">
                       <h6>Total registration</h6>
                       <h1 class="mt-2 mb-0"><?php echo $total_reg['count']?></h1>
                    </div>
                 </div>
                 <div class="col-md-6 mb-4">
                    <div class="card text-center p-3 text-primary">
                       <h6>Queries</h6>
                       <h1 class="mt-2 mb-0"><?php echo $total_queries['count']?></h1>
                    </div>
                 </div>
              </div>

              <!-- User Stats -->
              <h5>Users</h5>
              <div class="row mb-3">
                 <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-info">
                       <h6>Total</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_users['total']?></h1>
                    </div>
                 </div>
                 <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-success">
                       <h6>Active</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_users['active']?></h1>
                    </div>
                 </div>
                 <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-warning">
                       <h6>Inactive</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_users['inactive']?></h1>
                    </div>
                 </div>
                 <div class="col-md-3 mb-4">
                    <div class="card text-center p-3 text-danger">
                       <h6>Unverified</h6>
                       <h1 class="mt-2 mb-0"><?php echo $current_users['unverified']?></h1>
                    </div>
                 </div>
              </div>

            </div>

        </div>
    </div>

    <?php require ('inc/scripts.php');?>
</body>

</html>