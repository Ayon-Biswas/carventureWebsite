<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - ABOUT</title>
  <style>
    .box{
      border-top-color: var(--teal) !important;
    }
  </style>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include "inc/header.php";?>

  <!-- About us heading -->
  <div class="my-5 px-4">
    <h2 class="text-center fw-bold h-font">About Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
    Driven by passion, our car rental service aims to provide reliable vehicles, exceptional service.<br>An unforgettable journeys for every customer.
    </p>
  </div>

  <!-- ayon -->
  <div class="container">  
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">Ayon Biswas.</h3>
        <p>
          Hello there! i am Ayon Biswas.
          I am a student of Leading University,Sylhet.
          Car Venture is a dream come true for me.
          To reach out to people and witness the joy of car ownership!my kind of happiness.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-1 order-1 rounded">
       <img src="images/about/AYON.jpg" class="w-100" height="278.8px">
      </div>
    </div>
  </div>
  <!-- boby -->
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <h3 class="mb-3">Boby Rani Das</h3>
        <p>
          Hey there! i am Boby.
          I also am a student of Leading University,Sylhet.
          Awaken the nomadic wanderlust withing you.
          Let your with rental car be with us,happy travel.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-1 order-md-2 order-2 rounded">
       <img src="images/about/Boby.jpg" class="w-100" height="278.8px">
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/car-front-fill.svg" width="70px">
          <h4>Find your choice of Cars</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/person-arms-up.svg" width="70px">
          <h4>Enjoy the feeling of car ownership</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
          <img src="images/about/memory.svg" width="70px">
          <h4>Make Memories that last</h4>
        </div>
      </div>
    </div>
  </div>  

  <!-- Footer -->
  <?php include "inc/footer.php";?>

</body>

</html>