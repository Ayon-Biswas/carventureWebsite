<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Venture - HOME</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require ('inc/links.php') ?>
  
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
      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img
            src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1024,h_800/w_63,x_11,y_11,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/by1e7ylfkih7m7eji4yf/HuaHinPrivateCarCharterfromPattayabyThaiRhythm.webp"
            class="card-img-top">
          <div class="card-body">
            <h5>Sample Car Name</h5>
            <h6 class="mb-4">৳2000 Per day</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                180 hp
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                4 seater
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Heated Seats in winter
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Bluetooth connectivity
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Keyless Entry
              </span>
            </div>
            <div class="passengers mb-4">
              <h6 class="mb-1">Passengers</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                5 Passengers 
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
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img
            src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1024,h_800/w_63,x_11,y_11,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/by1e7ylfkih7m7eji4yf/HuaHinPrivateCarCharterfromPattayabyThaiRhythm.webp"
            class="card-img-top">
          <div class="card-body">
            <h5>Sample Car Name</h5>
            <h6 class="mb-4">৳2000 Per day</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                180 hp
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                4 seater
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Heated Seats in winter
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Bluetooth connectivity
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Keyless Entry
              </span>
            </div>
            <div class="passengers mb-4">
              <h6 class="mb-1">Passengers</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                5 Passengers 
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
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
          <img
            src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1024,h_800/w_63,x_11,y_11,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/by1e7ylfkih7m7eji4yf/HuaHinPrivateCarCharterfromPattayabyThaiRhythm.webp"
            class="card-img-top">
          <div class="card-body">
            <h5>Sample Car Name</h5>
            <h6 class="mb-4">৳2000 Per day</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                180 hp
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                4 seater
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Heated Seats in winter
              </span>
            </div>
            <div class="facilities mb-4">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Bluetooth connectivity
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Keyless Entry
              </span>
            </div>
            <div class="passengers mb-4">
              <h6 class="mb-1">Passengers</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                5 Passengers 
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
              <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 text-center mt-5">
        <a href="" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Cars >>></a>
      </div>
    </div>
  </div>

  <!-- Facilities -->
  <h2 class="mt-5 pt-4 text-center fw-bold h-font">Our Facilities</h2>

  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
        <img src="images/features/android.svg" width="80px" alt="">
        <h5 class="mt-3">Android Auto</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
        <img src="images/features/apple.svg" width="80px" alt="">
        <h5 class="mt-3">Apple Carplay</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
        <img src="images/features/wind.svg" width="80px" alt="">
        <h5 class="mt-3">AC enabled</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
        <img src="images/features/bluetooth.svg" width="80px" alt="">
        <h5 class="mt-3">Bluetooth</h5>
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
<!-- Footer -->
<?php include "inc/footer.php";?>

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
  </script>
</body>

</html>
