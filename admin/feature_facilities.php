<?php 
require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

if(isset($_GET['seen']))
{
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){ //all is for implementing Mark all as read
        $q="UPDATE `user_queries` SET `seen`=?";
        $values=[1]; //we have passed 1 to `seen` which will mark all as read
        if(update($q,$values,'i')){   //'ii' means data type.integer(i).update is coded in db_config.php
          alert('success','Marked all as read');
        }
        else{
          alert('error','Operation Failed');
        } 
    }
    else{
      $q="UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
      $values=[1,$frm_data['seen']]; //we have to pass 1 to `seen`
      if(update($q,$values,'ii')){   //'ii' means data type.integer(i).update is coded in db_config.php
        alert('success','Marked as read');
      }
      else{
        alert('error','Operation Failed');
      }    
    }
}

if(isset($_GET['del']))
{
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){ //all is for implementing delete all 
        $q="DELETE FROM `user_queries`";
        if(mysqli_query($con,$q)){   //in delete all we have no values to pass.
          alert('success','All Data deleted!');
        }
        else{
          alert('error','Operation Failed');
        }
    }
    else{
      $q="DELETE FROM `user_queries` WHERE `sr_no`=?";
      $values=[$frm_data['del']]; //we have to pass the id `del`
      if(delete($q,$values,'i')){   //'i' means data type.integer(i).delete is coded in db_config.php
        alert('success','Data deleted!');
      }
      else{
        alert('error','Operation Failed');
      }    
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Feature & Facilities</title>
  <?php require ('inc/links.php');?>
</head>

<body class="bg-light">
  <?php require ('inc/header.php');?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">Feature & Facilities</h3>

        <!-- Features section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Features</h5>
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#feature-s">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
              <table class="table table-hover border">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="features-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- Facilities section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Facilities</h5>
              <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                data-bs-target="#facility-s">
                <i class="bi bi-plus-square"></i> Add
              </button>
            </div>

            <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
              <table class="table table-hover border">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">#</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Name</th>
                    <th scope="col" width="40%">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="facilities-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- Feature modal section -->
  <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="feature_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Feature</h5>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label fw-bold">Name</label>
              <input type="text" name="feature_name" class="form-control shadow-none" required>
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

<!-- Facility modal section -->
  <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="facility_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Facility</h5>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label fw-bold">Name</label>
              <input type="text" name="facility_name" class="form-control shadow-none" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Icon</label>
              <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="facility_desc" class="form-control shadow-none" rows="3"></textarea>
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

  <?php require ('inc/scripts.php');?>

  <script>
    let feature_s_form = document.getElementById('feature_s_form');
    let facility_s_form = document.getElementById('facility_s_form');

    feature_s_form.addEventListener('submit', function (e) {
      e.preventDefault();
      add_feature();
    });

    function add_feature() {
      let data = new FormData();
      data.append('name', feature_s_form.elements['feature_name']
      .value); //accessing feature_s_form id and through ".elements" array we are accessing the index feature_name.
      data.append('add_feature', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);

      xhr.onload = function () {
        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
          alert('success', 'New Feature Added');
          feature_s_form.elements['feature_name'].value = '';
          get_features();
        } else {
          alert('error', 'Server down!');

        }
      }
      xhr.send(data);
    }

    function get_features() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
        document.getElementById('features-data').innerHTML = this.responseText;
      }
      xhr.send('get_features');
    }

    function rem_feature(val) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function () {
        console.log(this.responseText);
        if (this.responseText == 1) {
          alert('success', 'Feature removed!');
          get_features();
        } else if (this.responseText == 'car_added') {
          alert('error', 'Feature is added in Car!');
        } else {
          alert('error', 'Server down!');
        }
      }
      xhr.send('rem_feature=' + val);
    }

    facility_s_form.addEventListener('submit', function (e) {
      e.preventDefault();
      add_facility();
    });

    function add_facility() {
      let data = new FormData();
      data.append('name', facility_s_form.elements['facility_name'].value); //accessing facility_s_form id and through ".elements" array we are accessing the index facility_name.
      data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
      data.append('desc', facility_s_form.elements['facility_desc'].value);
      data.append('add_facility', '');

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);

      xhr.onload = function () {
        var myModal = document.getElementById('facility-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'only SVG are allowed!');
        } 
        else if (this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 1MB!');
        } 
        else if (this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed. Server down!');
        } 
        else {
            alert('success', 'New Facility Added');
            facility_s_form.reset();
            get_facilities();
        }
      }
      xhr.send(data);
    }

    function get_facilities() {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
        document.getElementById('facilities-data').innerHTML = this.responseText;
      }
      xhr.send('get_facilities');
    }

    function rem_facility(val) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/feature_facilities.php", true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function () {
        console.log(this.responseText);
        if (this.responseText == 1) {
          alert('success', 'Facility removed!');
          get_facilities();
        } else if (this.responseText == 'car_added') {
          alert('error', 'Facility is added in Car!');
        } else {
          alert('error', 'Server down!');
        }
      }
      xhr.send('rem_facility=' + val);
    }

    window.onload = function () {
      get_features();
      get_facilities();
    }
  </script>

</body>

</html>