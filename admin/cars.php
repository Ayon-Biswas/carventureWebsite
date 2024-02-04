<?php 
require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Cars</title>
  <?php require ('inc/links.php');?>
</head>

<body class="bg-light">
  <?php require ('inc/header.php');?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">Cars</h3>

        <!-- Features section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="text-end mb-4">
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#add-car">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
              <table class="table table-hover border text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Milage</th>
                    <th scope="col">Passengers</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="car-data">
                </tbody>
              </table>
            </div>

          </div>
        </div> 

      </div>
    </div>
  </div>


  <!-- Add Car modal section -->
  <div class="modal fade" id="add-car" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="add_car_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Car</h5>
          </div>
         <div class="modal-body">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Name</label>
              <input type="text" name="name" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Milage</label>
              <input type="number" name="milage" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Price</label>
              <input type="number" name="price" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Quantity</label>
              <input type="number" name="quantity" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Adult (Max.)</label>
              <input type="number" name="adult" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Children (Max.)</label>
              <input type="number" name="children" min="1" class="form-control shadow-none" required>
            </div>
            <!-- features coming from database -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Features</label>
               <div class="row">
                <?php 
                 $res= selectAll('features');
                 while($opt = mysqli_fetch_assoc($res)){
                  echo"
                    <div class='col-md-3 mb-1'>
                      <label>
                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                        $opt[name]
                      </label>
                    </div>
                  ";
                 }
                ?>
               </div>
            </div>
            <!-- facilities coming from database -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Facilities</label>
               <div class="row">
                <?php 
                 $res= selectAll('facilities');
                 while($opt = mysqli_fetch_assoc($res)){
                  echo"
                    <div class='col-md-3 mb-1'>
                      <label>
                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                        $opt[name]
                      </label>
                    </div>
                  ";
                 }
                ?>
               </div>
            </div>
            <!-- description area off modal -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Description</label>
             <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
            </div>
          </div>
         </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary shadow-none border-dark"
              data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Car modal section -->
  <div class="modal fade" id="edit-car" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="edit_car_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Car</h5>
          </div>
         <div class="modal-body">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Name</label>
              <input type="text" name="name" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Milage</label>
              <input type="number" name="milage" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Price</label>
              <input type="number" name="price" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Quantity</label>
              <input type="number" name="quantity" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Adult (Max.)</label>
              <input type="number" name="adult" min="1" class="form-control shadow-none" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Children (Max.)</label>
              <input type="number" name="children" min="1" class="form-control shadow-none" required>
            </div>
            <!-- features coming from database -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Features</label>
               <div class="row">
                <?php 
                 $res= selectAll('features');
                 while($opt = mysqli_fetch_assoc($res)){
                  echo"
                    <div class='col-md-3 mb-1'>
                      <label>
                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                        $opt[name]
                      </label>
                    </div>
                  ";
                 }
                ?>
               </div>
            </div>
            <!-- facilities coming from database -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Facilities</label>
               <div class="row">
                <?php 
                 $res= selectAll('facilities');
                 while($opt = mysqli_fetch_assoc($res)){
                  echo"
                    <div class='col-md-3 mb-1'>
                      <label>
                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                        $opt[name]
                      </label>
                    </div>
                  ";
                 }
                ?>
               </div>
            </div>
            <!-- description area off modal -->
            <div class="col-12 mb-3">
             <label class="form-label fw-bold">Description</label>
             <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
            </div>
            <input type="hidden" name="car_id">
          </div>
         </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary shadow-none border-dark"
              data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Manage Car images modal section -->
 <div class="modal fade" id="car-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Car Name</h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="image-alert">

        </div>
        <div class="border-bottom border-3 pb-3 mb-3">
          <form id="add_image_form">
           <label class="form-label fw-bold">Add Image</label>
           <input type="file" name="image" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none mb-3" required>
           <button class="btn custom-bg text-white shadow-none">ADD</button>
           <input type="hidden" name="car_id">
          </form>
        </div>
        <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
              <table class="table table-hover border text-center">
                <thead>
                  <tr class="bg-dark text-light sticky-top">
                    <th scope="col" width="60%">Image</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody id="car-image-data">
                </tbody>
              </table>
            </div>
      </div>
    </div>
  </div>
 </div>


  <?php require ('inc/scripts.php');?>
  <script>
    let add_car_form = document.getElementById('add_car_form');

    add_car_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_car();
    });


   function add_car() {
   let data = new FormData();
   data.append('add_car', '');
   data.append('name', add_car_form.elements['name'].value);
   data.append('milage', add_car_form.elements['milage'].value);
   data.append('price', add_car_form.elements['price'].value);
   data.append('quantity', add_car_form.elements['quantity'].value);
   data.append('adult', add_car_form.elements['adult'].value);
   data.append('children', add_car_form.elements['children'].value);
   data.append('desc', add_car_form.elements['desc'].value);

   // Accessing features of form. The data of which is coming from the database as inputs and labels.
   let features = [];
   let featureElements = add_car_form.elements['features'];
   for (let i = 0; i < featureElements.length; i++) {
    if (featureElements[i].type === 'checkbox' && featureElements[i].checked) {
      features.push(featureElements[i].value);
    }
   }

   // Accessing facilities of form. The data of which is coming from the database as inputs and labels.
   let facilities = [];
   let facilityElements = add_car_form.elements['facilities'];
   for (let i = 0; i < facilityElements.length; i++) {
    if (facilityElements[i].type === 'checkbox' && facilityElements[i].checked) {
      facilities.push(facilityElements[i].value);
    }
   }

   data.append('features', JSON.stringify(features));
   data.append('facilities', JSON.stringify(facilities));

   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/cars.php", true);

   xhr.onload = function () {
    var myModal = document.getElementById('add-car');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert('success', 'New Car Added');
      add_car_form.reset();
      get_all_cars();
    } else {
      alert('error', 'Server down!');
    }
   }
    xhr.send(data);
   }
  
  function get_all_cars(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
    document.getElementById('car-data').innerHTML = this.responseText;
   }

    xhr.send('get_all_cars');
  }

  let edit_car_form = document.getElementById('edit_car_form');

  //need some observation
  function edit_details(id) {
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax/cars.php", true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

   xhr.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_car_form.elements['name'].value = data.cardata.name;
    edit_car_form.elements['milage'].value = data.cardata.milage;
    edit_car_form.elements['price'].value = data.cardata.price;
    edit_car_form.elements['quantity'].value = data.cardata.quantity;
    edit_car_form.elements['adult'].value = data.cardata.adult;
    edit_car_form.elements['children'].value = data.cardata.children;
    edit_car_form.elements['desc'].value = data.cardata.description;
    edit_car_form.elements['car_id'].value = data.cardata.id;

   }
    xhr.send('get_car=' + id);
  }

  edit_car_form.addEventListener('submit',function(e){
      e.preventDefault();
      submit_edit_car();
    });

    function  submit_edit_car() {
  let data = new FormData();
  data.append('edit_car', '');
  data.append('car_id', edit_car_form.elements['car_id'].value);
  data.append('name', edit_car_form.elements['name'].value);
  data.append('milage', edit_car_form.elements['milage'].value);
  data.append('price', edit_car_form.elements['price'].value);
  data.append('quantity', edit_car_form.elements['quantity'].value);
  data.append('adult', edit_car_form.elements['adult'].value);
  data.append('children', edit_car_form.elements['children'].value);
  data.append('desc', edit_car_form.elements['desc'].value);

  // Accessing features of form. The data of which is coming from the database as inputs and labels.
  let features = [];
  let featureElements = edit_car_form.elements['features'];
  for (let i = 0; i < featureElements.length; i++) {
    if (featureElements[i].type === 'checkbox' && featureElements[i].checked) {
      features.push(featureElements[i].value);
    }
  }

  // Accessing facilities of form. The data of which is coming from the database as inputs and labels.
  let facilities = [];
  let facilityElements = edit_car_form.elements['facilities'];
  for (let i = 0; i < facilityElements.length; i++) {
    if (facilityElements[i].type === 'checkbox' && facilityElements[i].checked) {
      facilities.push(facilityElements[i].value);
    }
  }

  data.append('features', JSON.stringify(features));
  data.append('facilities', JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/cars.php", true);

  xhr.onload = function () {
    var myModal = document.getElementById('edit-car');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert('success', 'Car Data Edited');
      edit_car_form.reset();
      get_all_cars();
    } else {
      alert('error', 'Server down!');
    }
  }
    xhr.send(data);
  }

  function toggle_status(id,val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
     if(this.responseText == 1){
      alert('success', 'status toggled');
      get_all_cars();
     }
     else{
      alert('error', 'Server down');
     }
    }
    xhr.send('toggle_status='+id+'&value='+val);
  }

  // images of car section
  let add_image_form = document.getElementById('add_image_form');

  add_image_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_image();
  });

  function add_image() {
    let data = new FormData();
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('car_id',add_image_form.elements['car_id'].value);
    data.append('add_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/cars.php",true);//we are using FormData.So no need for request header.

    xhr.onload = function()
    {
        if (this.responseText == 'inv_img') {
            alert('error', 'only JPG, WEBP, JPEG or PNG are allowed!','image-alert');
        } 
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2MB!','image-alert');
        } 
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed. Server down!','image-alert');
        } 
        else {
            alert('success', 'New Image Added','image-alert');
            car_images(add_image_form.elements['car_id'].value,document.querySelector("#car-images .modal-title").innerText);
            add_image_form.reset();
            
        }
    }
    xhr.send(data);
  }

  function car_images(id,cname)
  {
    //selecting the name of car within #car-image a class named ".modal-title" and put in innertext
    document.querySelector("#car-images .modal-title").innerText = cname;
    add_image_form.elements['car_id'].value = id;
    add_image_form.elements['image'].value = '';//suppose if we select an image and dont upload it the shouldn't remain selected.if we close the modal the it will be fresh

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cars.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
     document.getElementById('car-image-data').innerHTML = this.responseText;
    }
    xhr.send('get_car_images='+id);

  }

  function rem_image(img_id,car_id)
  {
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('car_id',car_id);
    data.append('rem_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/cars.php",true);//we are using FormData.So no need for request header.

    xhr.onload = function()
    {
        if (this.responseText == 1) {
          alert('success', 'Image Removed','image-alert');
          car_images(car_id,document.querySelector("#car-images .modal-title").innerText);
        } 
        else {
          alert('error', 'Image removal failed!','image-alert');
        }
    }
    xhr.send(data);
  }

  function thumb_image(img_id,car_id)
  {
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('car_id',car_id);
    data.append('thumb_image','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/cars.php",true);//we are using FormData.So no need for request header.

    xhr.onload = function()
    {
        if (this.responseText == 1) {
          alert('success', 'Image Thumbnail changed','image-alert');
          car_images(car_id,document.querySelector("#car-images .modal-title").innerText);
        } 
        else {
          alert('error', 'Thumbnail Update failed!','image-alert');
        }
    }
    xhr.send(data);
  }

  function remove_car(car_id)
  {
    if(confirm("Are you sure you want to delete this car?")) //confirm() method of js shows a dialog box with a message,OK and Cancel button
    {
      let data = new FormData();
      data.append('car_id',car_id);
      data.append('remove_car','');

      let xhr = new XMLHttpRequest();
     xhr.open("POST","ajax/cars.php",true);//we are using FormData.So no need for request header.

     xhr.onload = function()
     {
        if (this.responseText == 1) {
          alert('success', 'Car Removed');
          get_all_cars();
        } 
        else {
          alert('error', 'Car removal failed!');
        }
     }
    xhr.send(data);
    }
    
  }

  window.onload = function(){
    get_all_cars();
  }
</script>

</body>

</html>