<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - CAR DETAILS</title>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include "inc/header.php";?>

  <!-- car details -->
  <?php
  if(!isset($_GET['id'])){
    redirect('cars.php');
  }

  $data = filteration($_GET);
  $car_res =select("SELECT * FROM `cars` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii'); //`status` should be 1 `removed` should be 0."ii" are integer datatypes.

  if(mysqli_num_rows($car_res)==0){
    redirect('cars.php');
  }

  $car_data=mysqli_fetch_assoc($car_res);
  ?>

  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="text-center"><?php echo $car_data['name'] ?></h2>
        <div style="font-size:14px;">
          <a href="index.php" class="text-secondary text-decoration-none">Home</a>
          <span class="text-secondary"> > </span>
          <a href="cars.php" class="text-secondary text-decoration-none">Cars</a>
        </div>
      </div>


      <div class="col-lg-7 col-md-12 px-4">
        <div id="carCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <?php 
            //getting image of cars(thumbnail+others if any) in carousel.
            // if no thumbnail is selected then the deafult image will be shown.
             $car_img = CARS_IMG_PATH."thumbnail.png";
             $img_q=mysqli_query($con,"SELECT * FROM `car_images` WHERE `car_id`='$car_data[id]'");
      
             if(mysqli_num_rows($img_q)>0)
             {
               $active_class='active';

               while($img_res = mysqli_fetch_assoc($img_q))
               {
                echo "
                <div class='carousel-item $active_class'> 
                  <img src='".CARS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                </div>
               ";
               $active_class='';//there may be more than one image.if the loop runs it will set the active class value to blank
               }
              
             }
             else
             {
              echo"<div class='carousel-item active'> 
                   <img src='$car_img' class='d-block w-100'>
                  </div>";
             }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="col-lg-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
          <div class="card-body">
            <!-- dynamic details page section (price,rating,features,facilities,milage)  -->
            <?php
           echo <<<price
           <h4>৳$car_data[price] Per day</h4>
           price;

           echo <<<rating
           <div class="mb-3">
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
             <i class="bi bi-star-fill text-warning"></i>
           </div>
           rating;

           //get features of car
           $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
           INNER JOIN `car_features` cfea ON f.id = cfea.features_id 
           WHERE cfea.car_id = '$car_data[id]'");

           $features_data = "";

            while($fea_row = mysqli_fetch_assoc($fea_q)){
              $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fea_row[name]</span>";
            }

            echo<<<features
             <div class="mb-3">
              <h6 class="mb-1">Features</h6>
              $features_data
             </div>
            features;

           //get facilities of car
           $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
           INNER JOIN `car_facilities` cfac ON f.id = cfac.facilities_id 
           WHERE cfac.car_id = '$car_data[id]'");

           $facilities_data = "";

            while($fac_row = mysqli_fetch_assoc($fac_q)){
             $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>$fac_row[name]</span>";
            }

            echo<<<facilities
             <div class="mb-3">
              <h6 class="mb-1">Facilities</h6>
              $facilities_data
             </div>
            facilities;

            echo<<<passengers
                  <div class="mb-3">
                    <h6 class="mb-1">Passengers</h6>
                     <span class="badge rounded-pill bg-light text-dark text-wrap">
                       $car_data[adult] Adults
                     </span>
                     <span class="badge rounded-pill bg-light text-dark text-wrap">
                     $car_data[children] Children
                     </span>
                  </div>
            passengers;

            echo<<<milage
            <div class="mb-3">
              <h6 class="mb-1">Milage</h6>
              <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
               $car_data[milage] MPG
              </span>
             </div>
            milage;
             //canceling book now btn if site is shutdown
              if(!$settings_r['shutdown']){
                $login = 0;
                if(isset($_SESSION['login']) && $_SESSION['login']==true)
                  {
                    $login = 1;
                  }
              echo<<<book
               <button onclick='checkLoginToBook($login,$car_data[id])' class="btn w-100 text-white custom-bg shadow-none mb-1">Book Now</button>
            book;  
              }
            

           ?>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 px-4">
        <div class="mb-5">
          <h5>Description</h5>
          <p>
            <?php
            echo $car_data['description']
          ?>
          </p>
          <div>
            <h5>Reviews & Ratings</h5>
            <div>
              <div class="d-flex align-items-center mb-2">
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
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/footer.php";?>

</body>

</html>