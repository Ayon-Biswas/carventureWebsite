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
 
<!-- Contact -->
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
       <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe']?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
       <h5>Address</h5>
       <a href="<?php echo $contact_r['gmap']?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
        <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address']?>
       </a>

       <h5 class="mt-4">Call Us</h5>
        <a class="d-inline-block mb-2 text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn1']?>">
        <i class="bi bi-telephone-fill"></i> <?php echo $contact_r['pn1']?>
        </a>
        <br>
        <a class="d-inline-block text-decoration-none text-dark" href="tel: <?php echo $contact_r['pn2']?>">
        <i class="bi bi-telephone-fill"></i> <?php echo $contact_r['pn2']?>
        </a>

        <h5 class="mt-4">Email</h5>
        <a href="mailto: <?php echo $contact_r['email']?>" class="d-inline-block text-decoration-none text-dark">
         <i class="bi bi-envelope-at"></i> <?php echo $contact_r['email']?>
        </a>

        <h5 class="mt-4">Follow Us</h5>
        <a class="d-inline-block  text-dark fs-6 me-2" href="<?php echo $contact_r['tw']?>" target="_blank">
         <i class="bi bi-twitter-x"></i>
        </a>
        
        <a class="d-inline-block text-dark fs-6 me-2" href="<?php echo $contact_r['fb']?>" target="_blank">
         <i class="bi bi-facebook"></i>
        </a>
        
        <a class="d-inline-block text-decoration-none text-dark text-dark fs-6" href="<?php echo $contact_r['git']?>" target="_blank">
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
