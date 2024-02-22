<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require ('inc/links.php') ?>
  <title><?php echo $settings_r['site_title']?> - CARS</title>
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

      <div class="col-lg-9 col-md-12 px-4" id="cars-data">
       <!-- ajax/cars.php after if(isset($_GET['fetch_cars'])){} code was below -->
      <?php 
      
      ?>

      

      </div>

    </div>
  </div>


  <script>

    let cars_data = document.getElementById("cars-data");

    function fetch_cars()
    {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "ajax/cars.php?fetch_cars", true);

      xhr.onprogress = function(){

      }

      xhr.onload = function(){
        cars_data.innerHTML = this.responseText;
      }

      xhr.send();
    }
    fetch_cars();
  </script>

  <!-- Footer -->
  <?php include "inc/footer.php";?>

</body>

</html>