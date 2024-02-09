<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - HOME</title> 
  <style>
    .availability-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 575px) {
      .availability-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }
  </style>
</head>

<body class="bg-light">
  
<!-- Header -->
 <?php include "inc/header.php";?>
 
  <!-- Carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php 
           $res = selectAll('carousel');
           while($row = mysqli_fetch_assoc($res))
           {
             $path = CAROUSEL_IMG_PATH;
             echo <<<data
              <div class="swiper-slide">
               <img src="$path$row[image]" class="w-100 d-block" />
             </div>
             data;
            }
        ?>
      </div>
    </div>
  </div>

  <!-- check availability form -->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Pick-up</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Drop-off</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
              <label class="form-label" style="font-weight:500;">Adult</label>
              <select class="form-select shadow-none">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight:500;">Children</label>
              <select class="form-select shadow-none">
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Our Cars -->
  <h2 class="mt-5 pt-4 text-center fw-bold h-font">OUR CARS</h2>

  <div class="container">
    <div class="row">

    <?php 
      $car_res =select("SELECT * FROM `cars` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii'); //`status` should be 1 `removed` should be 0."ii" are integer datatypes.

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
        $book_btn = "<button onclick='checkLoginToBook($login,$car_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
       }

       //print Car Card section.heredoc method of printing. feature and facility data not fetching as it did'nt in scripts/cars.js
        echo <<<data
        
         <div class="col-lg-4 col-md-6 my-3">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img src="$car_thumb" class="card-img-top">
          <div class="card-body">
            <h5>$car_data[name]</h5>
            <h6 class="mb-4">৳$car_data[price]</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              $features_data 
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              $facilities_data 
            </div>
            <div class="passengers mb-4">
              <h6 class="mb-1">Passengers</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
               $car_data[adult] Adults
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
               $car_data[children] Children 
              </span>
            </div>
            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              $book_btn
              <a href="car_details.php?id=$car_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
            </div>
          </div>
         </div>
        </div>

        data;
      }
      ?>
      

      <div class="col-lg-12 text-center mt-5">
        <a href="cars.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Cars >>></a>
      </div>
    </div>
  </div>

  <!-- Facilities -->
  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Our Facilities</h2>

  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

    <?php 
      $res= mysqli_query($con,"SELECT * FROM`facilities` ORDER BY `id` DESC LIMIT 5");
      $path= FACILITIES_IMG_PATH;
      while($row = mysqli_fetch_assoc($res)){
      echo<<<data
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
        <img src="$path$row[icon]" width="60px" alt="">
        <h5 class="mt-3">$row[name]</h5>
      </div>
     data;
     }
   ?>
      <div class="col-lg-12 text-center mt-5">
        <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
      </div>
    </div>
  </div>
<!-- Testimonials -->
  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Testimonials</h2>

  <div class="container">
   <div class="swiper swiper-testimonials">
    <div class="swiper-wrapper">
      <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/wind.svg" width="30px">
            <h6 class="m-0 ms-2">Random User1</h6>
          </div>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Illo deleniti aliquam suscipit ut dolorum possimus
            magni iure maiores soluta quam.</p>
            <div class="rating">
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
            </div>
      </div>
      <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/wind.svg" width="30px">
            <h6 class="m-0 ms-2">Random User2</h6>
          </div>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Illo deleniti aliquam suscipit ut dolorum possimus
            magni iure maiores soluta quam.</p>
            <div class="rating">
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
          </div>
      </div>
      <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/features/wind.svg" width="30px">
            <h6 class="m-0 ms-2">Random User3</h6>
          </div>
           <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Illo deleniti aliquam suscipit ut dolorum possimus
            magni iure maiores soluta quam.</p>
            <div class="rating">
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
          </div>
      </div>
      
    </div>
    <div class="swiper-pagination"></div>
  </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Testimonials >>></a>
      </div>
<!-- Find Us @ -->
<?php

$contacts_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contacts_q,$values,'i'));
// print_r($contact_r)

?>
<h2 class="mt-5 pt-4 text-center fw-bold h-font">Find Us @</h2>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
     <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe']?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="bg-white p-4 rounded mb-4">
        <h5>Call Us</h5>
        <a class="d-inline-block mb-2 text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn1']?>">
        <i class="bi bi-telephone-fill"></i><?php echo $contact_r['pn1']?>
        </a>
        <br>
        <a class="d-inline-block text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn2']?>">
        <i class="bi bi-telephone-fill"></i><?php echo $contact_r['pn2']?>
        </a>
      </div>
      <div class="bg-white p-4 rounded mb-4">
        <h5>Follow Us</h5>
        <a class="d-inline-block mb-3" href="<?php echo $contact_r['tw']?>" target="_blank">
        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-twitter-x"></i>Twitter </span>
        </a>
        <br>
        <a class="d-inline-block mb-3" href="<?php echo $contact_r['fb']?>" target="_blank">
        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-facebook"></i> Facebook</span>
        </a>
        <br>
        <a class="d-inline-block text-decoration-none text-dark" href="<?php echo $contact_r['git']?>" target="_blank">
        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-github"></i> Github</span>
        </a>
      </div>
    </div>
  </div>
</div>

<!-- password reset modal -->
<div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="recovery-form">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center">
              <i class="bi bi-sheild-lock fs-3 me-2"></i>Setup New Password
            </h5>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label class="form-label">New Password</label>
              <input type="password" name="pass" required class="form-control shadow-none">
              <input type="hidden" name="email">
              <input type="hidden" name="token">
            </div>
            <div class="mb-3 text-end">
              <button type="button" class="btn shadow-none me-2"  data-bs-dismiss="modal">CANCEL</button>
              <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>


<!-- Footer -->
<?php include "inc/footer.php";?>


<?php
//showing modal and executing query inside script tag of swiper
if(isset($_GET['account_recovery']))
{
  $data = filteration($_GET);

  $t_date = date("Y-m-d");

  $query= select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
    [$data['email'],$data['token'],$t_date],'sss');
  
  if(mysqli_num_rows($query)==1){
    echo<<<showModal
    <script>
     var myModal = document.getElementById('recoveryModal');

     myModal.querySelector("input[name='email']").value = '$data[email]';
     myModal.querySelector("input[name='token']").value = '$data[token]';

     var modal = bootstrap.Modal.getOrCreateInstance(myModal);
     modal.show();
    </script> 

    showModal;
  }
  else{
    alert("error","Invalid or Expired link");
  }
}
?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView:1,
        },
        640: {
          slidesPerView:1,
        },
        768: {
          slidesPerView:2,
        },
        1024: {
          slidesPerView:3,
        },
      }
    });

    //recover account
    let recovery_form = document.getElementById('recovery-form');

    recovery_form.addEventListener('submit',function(e){
      e.preventDefault();

      let data = new FormData();
      data.append('email',recovery_form.elements['email'].value);
      data.append('token',recovery_form.elements['token'].value);
      data.append('pass',recovery_form.elements['pass'].value);
      data.append('recover_user','');

      var myModal = document.getElementById('recoveryModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
       if(this.responseText == 'failed'){
        alert('error','Account Reset failed!');
       }
       else{
        alert('success','Password updated');
        recovery_form.reset();
       }
    }

    xhr.send(data);
      
    });
  </script>
</body>

</html>
