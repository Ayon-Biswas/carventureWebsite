<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Venture - CARS</title>
  <?php require ('inc/links.php') ?>
</head>

<body class="bg-light">

  <!-- Header -->
  <?php include "inc/header.php";?>

  <!-- cars -->
  <div class="my-5 px-4">
    <h2 class="text-center fw-bold h-font">OUR CARS</h2>
    <div class="h-line bg-dark"></div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2">FILTERS</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
              data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">CHECK AVAILABILITY</h5>
                <label class="form-label">Pick-up</label>
                <input type="date" class="form-control shadow-none mb-3">
                <label class="form-label">Drop-off</label>
                <input type="date" class="form-control shadow-none">
              </div>
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">FACILITIES</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none mb-3 me-1">
                  <label class="form-label" for="f1">Facility 1</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f2" class="form-check-input shadow-none mb-3 me-1">
                  <label class="form-label" for="f2">Facility 2</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none mb-3 me-1">
                  <label class="form-label" for="f3">Facility 3</label>
                </div>
              </div>
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size:18px;">PASSENGERS</h5>
                <div class="d-flex">
                  <div class="me-3">
                    <label class="form-label">Adult</label>
                    <input type="number" class="form-control shadow-none mb-3">
                  </div>
                  <div>
                    <label class="form-label">Children</label>
                    <input type="number" class="form-control shadow-none mb-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>

      <div class="col-lg-9 col-md-12 px-4">

      <?php 
      $car_res =select("SELECT * FROM `cars` WHERE `status`=? AND `removed`=?",[1,0],'ii'); //`status` should be 1 `removed` should be 0."ii" are integer datatypes.

      while($car_data = mysqli_fetch_assoc($car_res))
      {
        //get features of car
        $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
        INNER JOIN `car_features` cfea ON f.id = cfea.features_id 
        WHERE cfea.car_id = '$car_data[id]'");

        $features_data = "";

        while($fea_row = mysqli_fetch_assoc($fea_q)){
          $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>$fea_row[name]</span>";

        }
        //get facilities of car
        $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
        INNER JOIN `car_facilities` cfac ON f.id = cfac.facilities_id 
        WHERE cfac.car_id = '$car_data[id]'");

        $facilities_data = "";

        while($fac_row = mysqli_fetch_assoc($fac_q)){
          $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap'>$fac_row[name]</span>";
       }
       //get thumbnail of image.if no thumbnail is selected then the deafult image will be shown.
       
       $car_thumb = CARS_IMG_PATH."thumbnail.png";
       $thumb_q=mysqli_query($con,"SELECT * FROM `car_images` WHERE `car_id`='$car_data[id]' AND `thumb`='1'");

       if(mysqli_num_rows($thumb_q)>0){
        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $car_thumb = CARS_IMG_PATH.$thumb_res['image'];
       }

       //print Car Card section.heredoc method of printing. feature and facility data not fetching as it did'nt in scripts/cars.js
        echo <<<data
        

        <div class="card mb-4 border-0 shadow">
        <!-- g-0 means gutter 0.gutter is the gap between column and content created by horizontal line -->
        <div class="row g-0 p-3 align-items-center">
          <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
            <img
              src="$car_thumb" class="img-fluid rounded">
          </div>
          <div class="col-md-5 px-lg-3 px-md-3 px-0">
            <h5 class="mb-3">$car_data[name]</h5>
            <div class="features mb-3">
              <h6 class="mb-1">Features</h6>
              $features_data 
            </div>
            <div class="facilities mb-3">
              <h6 class="mb-1">Facilities</h6>
              $facilities_data
            </div>
            <div class="passengers">
              <h6 class="mb-1">Passengers</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                $car_data[adult] Adults
              </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
              $car_data[children] Children
              </span>
            </div>
          </div>
          <div class="col-md-2 text-center">
           <h6 class="mb-4">৳$car_data[price] Per day</h6>
            <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
            <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none">More Details</a>
          </div>
        </div>
        </div>


        data;
      }
      ?>

      

      </div>

    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/footer.php";?>

</body>

</html>