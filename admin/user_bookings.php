<?php 
require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

if(isset($_GET['del']))
{
  $frm_data = filteration($_GET);
  $q="DELETE FROM `booking_details` WHERE `sr_no`=?";
   $values=[$frm_data['del']]; //we have to pass the id `del`
    if(delete($q,$values,'i')){   //'i' means data type.integer(i).delete is coded in db_config.php
      alert('success','Booking canceled!');
    }
    else{
      alert('error','Operation Failed');
    }  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Bookings</title>
    <?php require ('inc/links.php');?>
</head>

<body class="bg-light">
    <?php require ('inc/header.php');?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User Bookings</h3>

                <!-- User Bookings section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone no:</th>
                                        <th scope="col" width="20%">Address</th>
                                        <th scope="col">Pick Up</th>
                                        <th scope="col">Drop off</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $q= "SELECT * FROM `booking_details` ORDER BY `sr_no` DESC"; //DESC stands for descending order.So that we can see new data first.
                                     $data = mysqli_query($con,$q); //manual query no value passed all fixed.
                                     $i=1; //number of rows present till that will counting go
                                     
                                     // Cancel booking button section
                                     while($row = mysqli_fetch_assoc($data)){
                                        $cancel ='';
                                         $cancel.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";//anchor tag sends GET request to delete
                                        //heredoc method of printing 
                                        echo<<<query
                                          <tr>
                                           <td>$i</td>
                                           <td>$row[user_name]</td>
                                           <td>$row[phonenum]</td>
                                           <td>$row[address]</td>
                                           <td>$row[pickup]</td>
                                           <td>$row[dropoff]</td>
                                           <td>$cancel</td>
                                          </tr>
                                        query;
                                        $i++;
                                     }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require ('inc/scripts.php');?>
</body>

</html>