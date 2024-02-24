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
              <!-- facilities the reset button section -->
              <div class="border bg-light p-3 rounded mb-3">
                 <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px;">
                   <span>FACILITIES</span>
                   <button id="facilities_btn" onclick="facilities_clear()" class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
                 </h5>
                 <?php 
                 
                 ?>
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
              <!-- Passengers -->
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="d-flex align-items-center justify-content-between mb-3" style="font-size:18px;">
                   <span>PASSENGERS</span>
                   <button id="passenger_btn" onclick="passenger_clear()" class="btn shadow-none btn-sm text-secondary d-none">Reset</button>
                </h5>
                <div class="d-flex">
                  <div class="me-3">
                    <label class="form-label">Adults</label>
                    <input type="number" min="1" id ="adults" oninput="passengers_filter()" class="form-control shadow-none mb-3">
                  </div>
                  <div>
                    <label class="form-label">Childrens</label>
                    <input type="number" min="1" id ="childrens" oninput="passengers_filter()" class="form-control shadow-none mb-3">
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
    let adults = document.getElementById("adults");
    let childrens = document.getElementById("childrens");
    let passenger_btn = document.getElementById("passenger_btn");


    function fetch_cars()
    {
      let passengers = JSON.stringify({
        adults: adults.value,
        childrens: childrens.value
      });

      let xhr = new XMLHttpRequest();
      xhr.open("GET", "ajax/cars.php?fetch_cars&passengers="+passengers, true);

      xhr.onprogress = function(){
       cars_data.innerHTML = `<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
         <span class="visually-hidden">Loading...</span>
       </div>`;
      }

      xhr.onload = function(){
        cars_data.innerHTML = this.responseText;
      }

      xhr.send();
    }

    function passengers_filter(){
      if(adults.value>0 || childrens.value>0){
        fetch_cars();
        passenger_btn.classList.remove('d-none');
      }
    }

    function passenger_clear(){
      adults.value='';
      childrens.value='';
      passenger_btn.classList.add('d-none');
      fetch_cars();
    }



    fetch_cars();
  </script>

  <!-- Footer -->
  <?php include "inc/footer.php";?>

</body>

</html>