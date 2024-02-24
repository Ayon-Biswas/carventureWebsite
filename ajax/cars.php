<?php
require ('../admin/inc/db_config.php');
require ('../admin/inc/essentials.php');
date_default_timezone_set("Asia/Dhaka"); //php supported timezone under asia,dhaka the closest region to us.

session_start();

if(isset($_GET['fetch_cars']))
{
   //passengers data decode.if the adult/children index in passemgers is not empty then assign the value otherwise assign 0
   $passengers = json_decode($_GET['passengers'],true);
   $adults = ($passengers['adults']!='') ? $passengers['adults'] : 0;
   $childrens = ($passengers['childrens']!='') ? $passengers['childrens'] : 0;
    
    //count no of cars and output variable to store car cards
    $count_cars = 0;
    $output = "";

    //fetching settings table to check website is shutdown or not
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con,$settings_q,));
    
    //query for cars cards with passengers filter
    $car_res =select("SELECT * FROM `cars` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$childrens,1,0],'iiii'); //`status` should be 1 `removed` should be 0."ii" are integer datatypes.

    while($car_data = mysqli_fetch_assoc($car_res))
    {
      //get features of car
      $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
      INNER JOIN `car_features` cfea ON f.id = cfea.features_id 
      WHERE cfea.car_id = '$car_data[id]'");

      $features_data = "";

      while($fea_row = mysqli_fetch_assoc($fea_q)){
        $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap  me-1 mb-1'>$fea_row[name]</span>";

      }
      //get facilities of car
      $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
      INNER JOIN `car_facilities` cfac ON f.id = cfac.facilities_id 
      WHERE cfac.car_id = '$car_data[id]'");

      $facilities_data = "";

      while($fac_row = mysqli_fetch_assoc($fac_q)){
        $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap  me-1 mb-1'>$fac_row[name]</span>";
     }
     //get thumbnail of image.if no thumbnail is selected then the deafult image will be shown.
     
     $car_thumb = CARS_IMG_PATH."thumbnail.png";
     $thumb_q=mysqli_query($con,"SELECT * FROM `car_images` WHERE `car_id`='$car_data[id]' AND `thumb`='1'");

     if(mysqli_num_rows($thumb_q)>0){
      $thumb_res = mysqli_fetch_assoc($thumb_q);
      $car_thumb = CARS_IMG_PATH.$thumb_res['image'];
     }

    //canceling book now btn if site is shutdown
     $book_btn = "";
     if(!$settings_r['shutdown']){
      $login = 0;
      if(isset($_SESSION['login']) && $_SESSION['login']==true)
        {
          $login = 1;
        }
      $book_btn = "<button onclick='checkLoginToBook($login,$car_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Book Now</button>";
     }

     //print Car Card section.heredoc method of printing. feature and facility data not fetching as it did'nt in scripts/cars.js
      $output.="
      

      <div class='card mb-4 border-0 shadow'>
      <!-- g-0 means gutter 0.gutter is the gap between column and content created by horizontal line -->
      <div class='row g-0 p-3 align-items-center'>
        <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
          <img
            src='$car_thumb' class='img-fluid rounded'>
        </div>
        <div class='col-md-5 px-lg-3 px-md-3 px-0'>
          <h5 class='mb-3'>$car_data[name]</h5>
          <div class='features mb-3'>
            <h6 class='mb-1'>Features</h6>
            $features_data 
          </div>
          <div class='facilities mb-3'>
            <h6 class='mb-1'>Facilities</h6>
            $facilities_data
          </div>
          <div class='passengers'>
            <h6 class='mb-1'>Passengers</h6>
            <span class='badge rounded-pill bg-light text-dark text-wrap'>
              $car_data[adult] Adults
            </span>
            <span class='badge rounded-pill bg-light text-dark text-wrap'>
            $car_data[children] Children
            </span>
          </div>
        </div>
        <div class='col-md-2 text-center'>
         <h6 class='mb-4'>৳$car_data[price] Per day</h6>
          $book_btn
          <a href='car_details.php?id=$car_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>More Details</a>
        </div>
      </div>
      </div>
      ";

      $count_cars++;
    }
   
    if($count_cars>0){
      echo $output;
    }
    else{
        echo "<h3 class='text-center text-danger'>No Cars to show!</h3>";
    }

}

