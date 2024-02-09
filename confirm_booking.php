<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - CONFIRM BOOKING</title>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include "inc/header.php";?>

  <!-- /*
    check car id from url is present or not
    shutdown mode is active or not
    user is logged in or not
  */ -->
  <?php
  if(!isset($_GET['id'])|| $settings_r['shutdown']==true){
    redirect('cars.php');
  }
  else if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('cars.php');
  }

  //filter and get car and user data
  $data = filteration($_GET);
  $car_res =select("SELECT * FROM `cars` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii'); //`status` should be 1 `removed` should be 0."ii" are integer datatypes.

  if(mysqli_num_rows($car_res)==0){
    redirect('cars.php');
  }

  $car_data=mysqli_fetch_assoc($car_res);

   $_SESSION['car'] = [
    "id" => $car_data['id'],
    "name" => $car_data['name'],
    "price" => $car_data['price'],
    "payment" => null,
    "available" => false,
   ];
   
   $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",[$_SESSION['uId']],"i");
   $user_data = mysqli_fetch_assoc($user_res);
  ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="text-center">CONFIRM BOOKING</h2>
        <div style="font-size:14px;">
          <a href="index.php" class="text-secondary text-decoration-none">Home</a>
          <span class="text-secondary"> > </span>
          <a href="cars.php" class="text-secondary text-decoration-none">Cars</a>
          <span class="text-secondary"> > </span>
          <a href="#" class="text-secondary text-decoration-none">Confirm</a>
        </div>
      </div>

      <!-- card section of confirm booking page with img,name,price -->

      <div class="col-lg-7 col-md-12 px-4">
        <?php
        
        //get thumbnail of car.no carousel in confirm booking
       
       $car_thumb = CARS_IMG_PATH."thumbnail.png";
       $thumb_q=mysqli_query($con,"SELECT * FROM `car_images` WHERE `car_id`='$car_data[id]' AND `thumb`='1'");

       if(mysqli_num_rows($thumb_q)>0){
        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $car_thumb = CARS_IMG_PATH.$thumb_res['image'];
       }

       echo<<<data
       
       <div class="card p-3 shadow-sm rounded">
       <img src="$car_thumb" class="img-fluid rounded mb-3">
        <h5>$car_data[name]</h5>
        <h6>৳$car_data[price] per day</h6>
       </div>
       
       data;
        
        ?>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <form action="pay_now.php" method="POST" id="booking_form">
             <h6 class="mb-3">BOOKING DETAILS</h6>
             <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $user_data['address'] ?></textarea> 
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Pick up</label>
                <input name="pickup" onchange="check_availability()" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Drop off</label>
                <input name="dropoff" onchange="check_availability()" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-12">
                <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                 <span class="visually-hidden">Loading...</span>
                </div>

                <h6 class="mb-3 text-danger" id="pay_info">Provide Pick up and Drop off date!</h6>

               <button name="pay_now" class="btn w-100 text-white custom-bg shadow-none mb-1" disabled>Pay Now (Cash on Pickup)</button> 
              </div>
              
             </div>
            </form>
          </div>
        </div>
      </div>

      

    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/footer.php";?>

<script>
  let booking_form = document.getElementById('booking_form');
  let info_loader = document.getElementById('info_loader');
  let pay_info = document.getElementById('pay_info');

  function check_availability()
  {
   let pickup_val = booking_form.elements['pickup'].value;
   let dropoff_val = booking_form.elements['dropoff'].value;

   booking_form.elements['pay_now'].setAttribute('disabled',true); //setAttribute a js function.

   if(pickup_val!='' && dropoff_val!='')
   {
     pay_info.classList.add('d-none'); //hides the "d-none" class in h6 tag that prompts the user to select date
     pay_info.classList.replace('text-dark','text-danger');
     info_loader.classList.remove('d-none'); //removes the "d-none" class in spinner after the user to selects date

     let data = new FormData();

     data.append('check_availability','');
     data.append('pick_up',pickup_val);
     data.append('drop_off',dropoff_val);

     let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/confirm_booking.php", true);

      xhr.onload = function () 
      {
      let data = JSON.parse(this.responseText);
       
        if(data.status == 'pick_up_drop_of_equal')
        {
         pay_info.innerText="You cannot drop off on the same day!";
        }
        else if(data.status == 'drop_of_earlier')
        {
         pay_info.innerText= "Drop off date is earlier than the pickup date!";
        }
        else if(data.status == 'pick_up_earlier')
        {
         pay_info.innerText="Pick up date is earlier than today's date!";
        }
        else if(data.status == 'unavailable')
        {
         pay_info.innerText="Car is not available for this pickup date!";
        }
        else{
          // pay_info.innerText="No of Days: "+data.days+"<br> Total Amount to pay: ৳"+data.payment;
          pay_info.innerText = "No of Days: " + data.days + " & Total Amount to pay: ৳" + data.payment;
          pay_info.classList.replace('text-danger','text-dark');
          booking_form.elements['pay_now'].removeAttribute('disabled');
        }
        pay_info.classList.remove('d-none');
        info_loader.classList.add('d-none');
      }

    xhr.send(data);
   }
  }
</script>

</body>

</html>