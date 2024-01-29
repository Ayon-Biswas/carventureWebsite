<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Venture - CONTACT</title>
  <?php require ('inc/links.php') ?>
</head>

<body class="bg-light">
  
<!-- Header -->
 <?php include "inc/header.php";?>
 
<!-- Facilities -->
<div class="my-5 px-4">
  <h2 class="text-center fw-bold h-font">CONTACT US</h2>
  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
    Lorem ipsum dolor sit amet consectetur adipisicing elit.
    Quisquam sapiente deleniti suscipit assumenda quo? <br> Totam, fugiat veritatis! Repudiandae, consectetur corporis.
  </p>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 mb-5 px-4">

      <div class="bg-white rounded shadow p-4">
       <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.8376974352786!2d91.8000509783347!3d24.869392287999677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3751015addbec3b7%3A0x9e87b7be58b5f67e!2sLeading%20University!5e0!3m2!1sen!2sbd!4v1705842040254!5m2!1sen!2sbd" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       <h5>Address</h5>
       <a href="https://maps.app.goo.gl/yVw4xcwGqYzAUtHg7" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
        <i class="bi bi-geo-alt-fill"></i>Leading University,ragibnagar,kamalbazar,sylhet
       </a>

       <h5 class="mt-4">Call Us</h5>
        <a class="d-inline-block mb-2 text-decoration-none text-dark" href="tel: 01712140810">
        <i class="bi bi-telephone-fill"></i>01712140810
        </a>
        <br>
        <a class="d-inline-block text-decoration-none text-dark" href="tel: 01312892300">
        <i class="bi bi-telephone-fill"></i>01312892300
        </a>

        <h5 class="mt-4">Email</h5>
        <a href="mailto:ayonshirsho@gmail.com" class="d-inline-block text-decoration-none text-dark">
         <i class="bi bi-envelope-at"></i> ask ayonshirsho@gmail.com
        </a>

        <h5 class="mt-4">Follow Us</h5>
        <a class="d-inline-block  text-dark fs-6 me-2" href="#">
         <i class="bi bi-twitter-x"></i> 
        </a>
        
        <a class="d-inline-block text-dark fs-6 me-2" href="#">
         <i class="bi bi-facebook"></i>
        </a>
        
        <a class="d-inline-block text-decoration-none text-dark text-dark fs-6" href="#">
         <i class="bi bi-github"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 px-4">
      <div class="bg-white rounded shadow p-4">
        <form>
          <h5>Send A Message</h5>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Name</label>
              <input type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Email</label>
              <input type="email" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Subject</label>
              <input type="text" class="form-control shadow-none">
          </div>
          <div class="mt-3">
              <label class="form-label" style="font-weight: 500;">Message</label>
              <textarea class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
          </div>
          <button type="submit" class="btn btn-whit custom-bg mt-3 ">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include "inc/footer.php";?>

</body>

</html>
